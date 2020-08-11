export default {
  // the first parameter always
  setAllMessages (state, data) {
    state.messages = data;
  },
  setAllSpecificUserMessages (state, data) {
    state.specificUserMessages = data;
  },
}
