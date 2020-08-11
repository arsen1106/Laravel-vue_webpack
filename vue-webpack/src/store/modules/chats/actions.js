import axios from 'axios'

export default {
// after get data from backend we should save it into state by help mutation
  fetchMessages ({commit}, page = 1) {
    return new Promise(async (resolve, reject) => {
      await axios.get(`/messages?page=${page}`)
        .then((response) => {
          commit('setAllMessages', response.data.data)
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

  fetchSpecificUserMessages ({commit}, specificUserId, page = 1) {
    return new Promise(async (resolve, reject) => {
      await axios.get(`/messages/specific-user/${specificUserId}?page=${page}`)
        .then((response) => {
          commit('setAllSpecificUserMessages', response.data.data)
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },

}
