<template>
  <div class="header navbar">
    <div class="header-container">
      <ul class="nav-left">
        <li>
          <a id='sidebar-toggle' class="sidebar-toggle" href="javascript:void(0);">
            <i class="ti-menu"></i>
          </a>
        </li>
        <li class="search-box">
          <a class="search-toggle no-pdd-right" href="javascript:void(0);">
            <i class="search-icon ti-search pdd-right-10"></i>
            <i class="search-icon-close ti-close pdd-right-10"></i>
          </a>
        </li>
        <li class="search-input">
          <input class="form-control" type="text" placeholder="Search...">
        </li>
      </ul>

      <ul class="nav-right d-flex">
        <NotificationComponent v-if="$auth.check('-1')"></NotificationComponent>
        <ChatComponent></ChatComponent>
        <SettingsComponent></SettingsComponent>
      </ul>
    </div>
  </div>
</template>

<script>
    import NotificationComponent from "./items/NotificationComponent";
    import ChatComponent from "./items/ChatComponent";
    import SettingsComponent from "./items/SettingsComponent";
    import {mapActions, mapGetters} from "vuex";
    export default {
      name: "HeaderComponent",
      components: {SettingsComponent, ChatComponent, NotificationComponent},
      data:function () {
        return {

        }
      },
    }
</script>

<style scoped>

</style>
