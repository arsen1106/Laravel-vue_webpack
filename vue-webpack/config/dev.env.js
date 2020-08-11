'use strict'
const merge = require('webpack-merge')
const prodEnv = require('./prod.env')

module.exports = merge(prodEnv, {
  NODE_ENV: '"development"',
  BACKEND_URL: '"http://localhost:8000/api/v1"',

  PUSHER:{
    APP_ID:'"1012346"',
    APP_KEY:'"8bb1af468802446f05b9"',
    APP_SECRET:"'9a39470655336f54554a'",
    APP_CLUSTER:'"mt1"',
  },
})
