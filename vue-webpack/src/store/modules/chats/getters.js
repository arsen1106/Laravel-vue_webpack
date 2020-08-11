export default {
  // the first parameter always
  allMessages: function (state) {
    return state.messages
  },
  allSpecificUserMessages: function (state) {
    return state.specificUserMessages
  }
}
