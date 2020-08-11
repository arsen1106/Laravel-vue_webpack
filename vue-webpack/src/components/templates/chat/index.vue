<template>
    <div class="peers fxw-nw pos-r w-100">
      <!-- Sidebar -->
      <div class="peer bdR" id="chat-sidebar">
        <div class="layers h-100">
          <!-- Search -->
          <div class="bdB layer w-100">
            <label>
              <input type="text" placeholder="Search contacts..." name="chatSearch" class="form-constrol p-15 bdrs-0 w-100 bdw-0">
            </label>
          </div>

          <!-- List -->
          <div class="layer w-100 fxg-1 scrollable pos-r">

            <chat-user-component
              v-for="(user,key) in  users"
              :user="user"
              :key="key"
              @openChat="openChat"
            >
            </chat-user-component>

          </div>
        </div>
      </div>

      <!-- Chat Box -->
      <div class="peer peer-greed" id='chat-box'>
          <messages-header-component
            :user="chatUser"
            :typing="typing"
          >
          </messages-header-component>

          <div class="layer w-100 fxg-1 bgc-grey-200 scrollable pos-r">
            <div class="p-20 gapY-15">
              <messages-component
                v-if="messages.length !== 0"
                v-for="(message,key) in  messages"
                :key="key"
                :message="message"
              >
              </messages-component>
            </div>
          </div>

          <messages-footer-component
            :user="chatUser"
            @sentMessage = 'sentMessage'
            @typing = 'isTyping'
          >
          </messages-footer-component>
      </div>
    </div>
</template>

<script>
  import {mapActions, mapGetters} from 'vuex'
  import ChatUserComponent from "./items/ChatUserComponent";
  import MessagesHeaderComponent from "./items/MessagesHeaderComponent";
  import MessagesComponent from "./items/MessagesComponent";
  import MessagesFooterComponent from "./items/MessagesFooterComponent";

  export default {
      name: "index",
      data:function(){
        return {
          chatUser:{},
          typing:false,
        }
      },
      components: {
        MessagesFooterComponent,
        MessagesComponent,
        MessagesHeaderComponent,
        ChatUserComponent
      },

      methods:{
        ...mapActions(['fetchUsers','fetchSpecificUserMessages']),
        openChat:function (user) {
          this.fetchSpecificUserMessages( user.id);
          this.chatUser = user;
        },
        sentMessage:function (message) {
          this.messages.push(message)
        },

        chatEvents:function () {
          let _this = this;

          Echo.channel(`chat-${this.$auth.user().id}`).listenForWhisper('typing', (e) => {
            this.user = e.user;
            this.typing = e.typing;
            // remove is typing indicator after 0.9s
            setTimeout(function() {
              _this.typing = false
            }, 900);
          });

          Echo.channel(`chat_${this.$auth.user().id}`).listen("SendMessage", event => {
            this.messages.push(event.message)
          });
        },

        isTyping(userId) {
          let channel = Echo.channel(`chat-${userId}`);
          setTimeout(() => {
            channel.whisper('typing', {
              user: this.$auth.user(),
              typing: true
            });
          }, 300);
        },
      },
      computed:{
        ...mapGetters({
          users:'allUsers',
          messages:'allSpecificUserMessages'
        }),
      },
      async mounted(){
        this.fetchUsers();
        this.chatEvents();
      },
      watch: {
        users(newValue, oldValue) {
          if( newValue.lenght !== 0 ){
            this.chatUser = newValue[0];
            this.fetchSpecificUserMessages( this.chatUser.id );
          }
        },
      },
    }
</script>

<style scoped>

</style>
