import axios from 'axios'

export default {
// after get data from backend we should save it into state by help mutation
   getAllContactUsNotifications({commit}) {
    return new Promise(async (resolve, reject) => {
      await axios.get('/notifications/contact-us/')
        .then((response) => {
          commit('setAllContactUsNotifications', response.data.data)
          resolve(response)
        })
        .catch((error) => {
          reject(error)
        })
    })
  },
}
