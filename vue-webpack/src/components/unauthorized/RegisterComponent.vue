<template>
  <div class="peers ai-s fxw-nw h-100vh">
    <div class="peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv">
      <div class="pos-a centerXY">
        <div class="bgc-white bdrs-50p pos-r" style='width: 120px; height: 120px;'>
          <img class="pos-a centerXY" src="../../assets/theam/static/images/logo.png" alt="">
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4 peer peer-register pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
      <div class="d-flex justify-content-between">
        <h4 class="fw-300 c-grey-900 mB-40">Register</h4>
        <router-link :to="{ name : 'login' }" >Login</router-link>
      </div>
      <form  method="POST" autocomplete="off" @submit.prevent="register">
        <div class="form-group">
          <label class="text-normal text-dark">Username</label>
          <div>
              <input
                id="name"
                type="text"
                :class="['form-control', { 'is-invalid': error && errors.name }]"
                v-model="user.name"
                autocomplete="name"
                autofocus
              >
              <span
                class="invalid-feedback"
                role="alert"
                v-if="error && errors.name"
              >
                <strong>{{ errors.name[0] }}</strong>
              </span>
          </div>
        </div>
        <div class="form-group">
          <label class="text-normal text-dark">Email Address</label>
          <div>
              <input
                id="email"
                type="text"
                :class="['form-control', { 'is-invalid': error && errors.email }]"
                v-model="user.email"
                autocomplete="email"
              >
              <span
                class="invalid-feedback"
                role="alert"
                v-if="error && errors.email"
              >
                <strong>{{ errors.email[0] }}</strong>
              </span>
          </div>
        </div>
        <div class="form-group">
          <label class="text-normal text-dark">Password</label>
          <div>
              <input
                id="password"
                type="password"
                :class="['form-control', { 'is-invalid': error && errors.password }]"
                v-model="user.password"
                autocomplete="new-password"
              >
              <span
                class="invalid-feedback"
                role="alert"
                v-if="error && errors.password"
              ><strong>{{ errors.password[0] }}</strong>
              </span>
          </div>
        </div>
        <div class="form-group">
          <label class="text-normal text-dark">Confirm Password</label>
          <div>
              <input
                id="password-confirm"
                type="password"
                :class="['form-control', { 'is-invalid': error && errors.password_confirmation }]"
                v-model="user.password_confirmation"
                autocomplete="new-password"
              >
              <span
                class="invalid-feedback"
                role="alert"
                v-if="error && errors.password_confirmation"
              >
                <strong>{{ errors.password_confirmation[0] }}</strong>
              </span>
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Register</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
    export default {
        name: "RegisterComponent",
        data() {
            return {
                user:{
                    name: '',
                    email: '',
                    password: '',
                    password_confirmation:""
                },
                error: false,
                errors: {}
            };
        },
        methods: {
            register(){
                this.$auth.register({data: this.user})
                    .then(response => {
                        console.log(response)
                        this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
                    })
                    .catch(error => {
                        console.log(error.response)
                        this.error = true
                        this.errors = error.response.data.errors || {}
                    });
            }
        }
    };
</script>

<style scoped>
  div.peer{
    background-image: url("../../assets/theam/static/images/bg.jpg");
  }
  div.peer-register{
    background: white;
  }
</style>
