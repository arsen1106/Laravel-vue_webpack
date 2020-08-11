import Vue from 'vue'
import Vuex from 'vuex'

import users from './modules/users/store'
import notifications from './modules/notifications/store'
import chats from './modules/chats/store'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {},
  mutations: {},
  actions: {},
  getters: {},
  modules: {
    users,
    notifications,
    chats,
  }
})

export default store
