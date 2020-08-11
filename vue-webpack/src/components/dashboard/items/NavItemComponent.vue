<template>
  <ul class="sidebar-menu scrollable pos-r">
    <li class="nav-item mT-30 actived" v-for="(route, key) in navItems" v-bind:key="key" :rule='route.role'>
      <router-link
        :to="{ name : route.name }"
        :key="key"
        class="sidebar-link">
        <span class="icon-holder">
          <i :class="route.icon"></i>
        </span>
        <span class="title">{{route.name}}</span>
      </router-link>
    </li>
  </ul>
</template>

<script>
    export default {
        name: "NavItemComponent",
        props:{
          items:{
            type:Array,
            required:true
          }
        },
        data:function () {
          return {

          }
      },
      computed: {
        navItems: {
          get: function() {
            return this.items.filter((item) => {
                return item.type.includes(this.$auth.user().role)
            })
          },
        },
      }
    }
</script>

<style scoped>

</style>
