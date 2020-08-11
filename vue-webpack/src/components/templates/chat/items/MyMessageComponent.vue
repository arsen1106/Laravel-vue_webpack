<template>
  <div class="peers fxw-nw">
    <div class="peer mR-20">
      <img class="w-2r bdrs-50p" :src="(user && user.cover_photo) ? user.cover_photo : 'https://randomuser.me/api/portraits/men/11.jpg'" alt="">
    </div>
    <div class="peer peer-greed">
      <div class="layers ai-fs gapY-5">
        <div class="layer">
          <div class="peers fxw-nw ai-c pY-3 pX-10 bgc-white bdrs-2 lh-3/2">
            <div class="peer mR-10">
              <small>{{ message.created_at }}</small>
            </div>
            <div class="peer-greed">
              <span>{{message.text}}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        name: "MyMessageComponent",
        props:{
          user:{
            type:Object,
          },
          message:{
            type:Object,
          }
        }
    }
</script>

<style scoped>

</style>
