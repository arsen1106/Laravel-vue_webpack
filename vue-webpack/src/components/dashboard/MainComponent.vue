<template>
  <!-- ### $App Screen Content ### -->
  <main class='main-content bgc-grey-100'>
    <div id='mainContent'>
      <div class="row gap-20 masonry pos-r">
        <router-view></router-view>
      </div>
    </div>
  </main>
</template>

<script>
    export default {
        name: "MainComponent"
    }
</script>

<style scoped>

</style>
