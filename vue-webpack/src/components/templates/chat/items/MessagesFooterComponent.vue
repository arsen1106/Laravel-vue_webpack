<template>
  <div class="layer w-100">
    <!-- Chat Send -->
    <div class="p-20 bdT bgc-white">
      <div class="pos-r">
        <label style="width: 100%">
          <input @input="$emit('typing',user.id)" type="text" class="form-control bdrs-10em m-0" placeholder="Say something..." v-model="model.text">
        </label>
        <button @click="sendMsg()" type="button" class="btn btn-primary bdrs-50p w-2r p-0 h-2r pos-a r-1 t-1">
          <i class="fa fa-paper-plane-o"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<script>
    import axios from "axios";

    export default {
      name: "MessagesFooterComponent",
      data:function(){
        return {
          model:{
            text:''
          }
        }
      },
      props:{
        user:{
          type:Object,
        }
      },
      methods:{
        sendMsg:function () {
          if(this.model.text){
            var text = this.model.text;
            var userId = this.user.id;
            this.model.text = '';
            return new Promise(async (resolve, reject) => {
              await axios.post('/messages',{text:text,userId:userId})
                .then((response) => {
                  this.$emit('sentMessage',response.data.data);
                  resolve(response)
                })
                .catch((error) => {

                  reject(error)
                })
            })
          }
        }
      }

    }
</script>

<style scoped>

</style>
