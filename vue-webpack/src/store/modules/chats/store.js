import mutations from './mutations'
import getters from './getters'
import actions from './actions'

export default {
  state: {
    messages: [],
    specificUserMessages: [],
  },
  mutations,
  actions,
  getters
}
