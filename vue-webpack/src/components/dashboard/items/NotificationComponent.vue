<template>
  <li class="notifications dropdown">
    <span class="counter bgc-red">{{count}}</span>
    <a href="" class="dropdown-toggle no-after" data-toggle="dropdown">
      <i class="ti-bell"></i>
    </a>

    <ul class="dropdown-menu" >
      <li class="pX-20 pY-15 bdB">
        <i class="ti-bell pR-10"></i>
        <span class="fsz-sm fw-600 c-grey-900">Notifications</span>
      </li>
      <li>
        <ul class="ovY-a pos-r scrollable lis-n p-0 m-0 fsz-sm" style="max-height: 500px;">
          <li
            v-for="(notification, key) in notifications"
            :key="key"
          >
            <a href="" class='peers fxw-nw td-n p-20 bdB c-grey-800 cH-blue bgcH-grey-100'>
              <div class="peer mR-15">
                <img class="w-3r bdrs-50p" :src='notification.user.cover_photo' alt="">
              </div>
              <div class="peer peer-greed">
                <span>
                  <span class="fw-500">{{notification.user.name}}</span>
                  <span class="c-grey-600">Added new <span class="text-dark">contact us</span>
                  </span>
                </span>
                <p class="m-0">
                  <small class="fsz-xs">{{ notification.created_at }}</small>
                </p>
              </div>
            </a>
          </li>
        </ul>
      </li>
      <li class="pX-20 pY-15 ta-c bdT">
        <span>
          <a href="" class="c-grey-600 cH-blue fsz-sm td-n">View All Notifications <i class="ti-angle-right fsz-xs mL-10"></i></a>
        </span>
      </li>
    </ul>
  </li>
</template>

<script>
  import {mapActions, mapGetters} from "vuex";

  export default {
      name: "NotificationComponent",
      computed: {
        ...mapGetters({
          notifications:'notViewedContactUsNotifications',
        }),
        count: {
          get: function () {
            return this.notifications.length;
          },
        }
      },
      methods:{
        ...mapActions({
          getAllNotifications :'getAllContactUsNotifications',
        }),
      },
      async mounted(){
        this.getAllNotifications();
        Echo.channel("comment").listen("Contact", e => {
          this.notifications.push(e)
        });
      },
    }
</script>

<style scoped>

</style>
