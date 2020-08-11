<template>
  <div class="peers fxw-nw ai-fe">
    <div class="peer ord-1 mL-20">
      <img class="w-2r bdrs-50p" :src="(user && user.cover_photo) ? user.cover_photo : 'https://randomuser.me/api/portraits/men/11.jpg'" alt="">
    </div>
    <div class="peer peer-greed ord-0">
      <div class="layers ai-fe gapY-10">
        <div class="layer">
          <div class="peers fxw-nw ai-c pY-3 pX-10 bgc-white bdrs-2 lh-3/2">
            <div class="peer mL-10 ord-1">
              <small>{{ message.created_at }}</small>
            </div>
            <div class="peer-greed ord-0">
              <span>{{ message.text }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        name: "YouMessageComponent",
        props:{
          user:{
            types:Object,
          },
          message:{
            type:Object,
          }
        },
    }
</script>

<style scoped>

</style>
