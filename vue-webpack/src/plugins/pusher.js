import Echo from "laravel-echo";

window.Pusher = require('pusher-js');
Pusher.logToConsole = true;

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: process.env.PUSHER.APP_KEY,
  cluster: process.env.PUSHER.APP_CLUSTER,
  encrypted: true
});
