<template>
  <div @click="showMessages(user)" class="peers fxw-nw ai-c p-20 bdB bgc-white bgcH-grey-50 cur-p ">
    <div class="peer">
      <img :src='user.cover_photo' alt="" class="w-3r h-3r bdrs-50p">
    </div>
    <div class="peer peer-greed pL-20">
      <h6 class="mB-0 lh-1 fw-400">{{user.name + ' ' +user.surname}}</h6>
      <small class="lh-1 c-green-500">Online</small>
    </div>
  </div>
</template>

<script>
    export default {
      name: "ChatUserComponent",
      props:{
          user:{
            type:Object,
            required:true
          }
      },
      methods:{
        showMessages:function (user) {
            this.$emit('openChat',user);
        }
      }
    }
</script>

<style scoped>

</style>
