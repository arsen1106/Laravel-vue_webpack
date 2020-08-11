<template>
  <div>
    <my-message-component
      v-if="message.from_user_id === $auth.user().id"
      :user="message.fromUser"
      :message="message"
    >
    </my-message-component>
    <you-message-component
      v-else
      :user="message.fromUser"
      :message="message"
    >
    </you-message-component>
  </div>
</template>

<script>
  import MyMessageComponent from "./MyMessageComponent";
  import YouMessageComponent from "./YouMessageComponent";
  export default {
    name: "MessagesComponent",
    props:{
      message:{
        types:Object,
      },
    },
    components: {YouMessageComponent, MyMessageComponent},
    mounted() {

    }
  }
</script>

<style scoped>

</style>
