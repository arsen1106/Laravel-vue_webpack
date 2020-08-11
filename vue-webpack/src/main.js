// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
require("./assets/theam/scripts/index.js");
require("./assets/css/style.css");
require("./plugins/pusher");

import Vue from 'vue'
import App from './App'

import router from './router/routes'
import VueRouter from "vue-router";

import axios from 'axios'
import VueAxios from 'vue-axios'

import auth from './auth'
import VueAuth from '@websanova/vue-auth'

import store from './store/store'
import vuetify from './plugins/vuetify'

// Set Vue router
Vue.router = router

Vue.use(VueRouter)

Vue.use(VueAxios, axios)

axios.defaults.baseURL = process.env.BACKEND_URL
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.defaults.headers.common['Content-Type'] = 'application/json;charset=UTF-8';
axios.defaults.headers.common['Access-Control-Allow-Origin'] = true;
axios.defaults.headers.common['Access-Control-Allow-Credentials'] = true;

Vue.use(VueAuth, auth)

Vue.config.productionTip = false
Vue.config.backendUrl = process.env.BACKEND_URL

window.Vue = Vue

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  store,
  vuetify,
  render: h => h(App)
})
