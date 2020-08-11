export default {
  // the first parameter always
  allContactUsNotifications: function (state) {
    return state.notifications_contact_us
  },
  viewedContactUsNotifications: function (state) {
    return state.notifications_contact_us.filter(function (contact) {
      return contact.viewed === 1;
    });
  },
  notViewedContactUsNotifications:function (state) {
    return state.notifications_contact_us.filter(function (contact) {
      return contact.viewed !== 1;
    });
  },
}
