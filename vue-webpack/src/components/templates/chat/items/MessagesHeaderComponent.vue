<template>
  <div class="layer w-100">
    <div class="peers fxw-nw jc-sb ai-c pY-20 pX-30 bgc-white">
      <div class="peers ai-c">
        <div class="peer d-n@md+">
          <a href="" title="" id='chat-sidebar-toggle' class="td-n c-grey-900 cH-blue-500 mR-30">
            <i class="ti-menu"></i>
          </a>
        </div>
        <div class="peer mR-20">
          <img :src=" user ? user.cover_photo : 'https://randomuser.me/api/portraits/men/12.jpg'" alt="" class="w-3r h-3r bdrs-50p">
        </div>
        <div class="peer">
          <h6 class="lh-1 mB-0">{{user.name}}</h6>
          <i v-show="typing" class="fsz-sm lh-1">Typing...</i>
        </div>
      </div>
      <div class="peers">
        <a href="" class="peer td-n c-grey-900 cH-blue-500 fsz-md mR-30" title="">
          <i class="ti-video-camera"></i>
        </a>
        <a href="" class="peer td-n c-grey-900 cH-blue-500 fsz-md mR-30" title="">
          <i class="ti-headphone"></i>
        </a>
        <a href="" class="peer td-n c-grey-900 cH-blue-500 fsz-md" title="">
          <i class="ti-more"></i>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        name: "MessagesHeaderComponent",
        props:{
          user:{
            type:Object
          },
          typing:{
            type:Boolean
          }
        }
    }
</script>

<style scoped>

</style>
