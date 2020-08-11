<template>
  <div class="peers ai-s fxw-nw h-100vh">
    <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv">
      <div class="pos-a centerXY">
        <div class="bgc-white bdrs-50p pos-r" style='width: 120px; height: 120px;'>
          <img class="pos-a centerXY" src="../../assets/theam/static/images/logo.png" alt="">
        </div>
      </div>
    </div>
    <div class="col-12 col-md-4 peer peer-login pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
      <div class="d-flex justify-content-between">
          <h4 class="fw-300 c-grey-900 mB-40">Login</h4>
          <router-link :to="{ name : 'register' }" >Register</router-link>
      </div>

      <form method="POST" autocomplete="off" @submit.prevent="login" v-if="!success">
        <div class="text-center">
            <span class="text-danger" v-if="message" role="alert"><strong>{{ message }}</strong></span>
        </div>
        <div class="form-group">
          <label class="text-normal text-dark">Username</label>
          <input
            id="email"
            type="text"
            class="form-control"
            v-model="user.email"
            autocomplete="email"
            autofocus>
        </div>
        <div class="form-group">
          <label class="text-normal text-dark">Password</label>
          <input
            id="password"
            type="password"
            class="form-control"
            v-model="user.password"
            autocomplete="current-password">
        </div>
        <div class="form-group peer-checkbox">
          <div class="peers ai-c jc-sb fxw-nw">
            <div class="peer" style="background: white">
              <div class="checkbox checkbox-circle checkbox-info peers ai-c">
                <input
                  type="checkbox"
                  id="inputCall1"
                  v-model="user.rememberMe"
                  true-value=1
                  false-value=0
                  class="peer">
                <label for="inputCall1" class=" peers peer-greed js-sb ai-c">
                  <span class="peer peer-greed">Remember Me</span>
                </label>
              </div>
            </div>
            <div class="peer">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
          </div>
        </div>
      </form>
      <div class="form-group row text-center w-100">
        <div class="col-md-12">
          <!--Facebook-->
          <a
            @click="AuthProvider('facebook')"
            class="btn-floating btn-lg btn-fb"
            type="button"
            role="button">
            <i class="fab fa-facebook-f"></i>
          </a>
          <!--Twitter-->
          <a
            @click="AuthProvider('twitter')"
            class="btn-floating btn-lg btn-tw"
            type="button"
            role="button">
            <i class="fab fa-twitter"></i>
          </a>
          <!--Google +-->
          <a
            @click="AuthProvider('google')"
            class="btn-floating btn-lg btn-gplus"
            type="button"
            role="button">
            <i class="fab fa-google-plus-g"></i>
          </a>
          <!--Github-->
          <a
            @click="AuthProvider('github')"
            class="btn-floating btn-lg btn-git"
            type="button"
            role="button">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
        name: "RegisterComponent",
        data() {
            return {
                user:{
                    email: '',
                    password: '',
                    rememberMe: false
                },
                error:false,
                message:false,
                success: false,
                redirectToProfile:'Profile',
                redirectToDashboard :'Dashboard',
                isProcessing: false,
                isSocial:false,
            };
        },
        created(){
            this.hasSocialLogin();
        },
        methods: {
            login() {
                var redirect = this.$auth.redirect();
                var self = this;
                this.$auth.login({
                    data:{
                        email:self.user.email,
                        password:self.user.password,
                        rememberMe:self.user.rememberMe
                    },
                    success: function() {
                        const page = this.$auth.user().role === -1
                                ? self.redirectToDashboard
                                : self.redirectToProfile;
                        let redirectTo = redirect && redirect.from ? redirect.from.name : page;
                        this.$router.push({name: redirectTo})
                            .catch(error => { console.log(error) });
                    },
                    error: function(error) {
                        self.error = true
                        self.isSocial = false;
                        self.message = error.response.data.message
                    },
                    rememberMe: true,
                    fetchUser: true
                })
            },
            AuthProvider:function(provider){
                this.isProcessing = true;
                this.error = {};
                this.axios.get(`auth/social/${provider}`)
                    .then((response) => {
                        if(response.data.error){
                            this.error = err.response.data.error;
                        } else if(response.data.redirectUrl){
                            window.open(response.data.redirectUrl, 'mywin',`left=${500},top=${200},width=700,height=700,toolbar=1,resizable=0`); return false;
                        }
                    })
                    .catch((err) => {
                        if(err.response.data.error){
                            this.error = err.response.data.error;
                        }
                        this.isProcessing = false;
                    });
                this.isProcessing = false;
            },
            hasSocialLogin: function () {
                let token = this.$route.params.token;
                if( token ){
                    var self = this;
                    this.isSocial = true;
                    this.axios.get(`social-user/${token}`)
                        .then((response) => {
                            let socialUser = response.data.data;
                            if( socialUser ){
                                self.user.email = socialUser.user.email;
                                self.user.password = socialUser.password;
                                self.login();
                            }
                        })
                        .catch((err) => {
                            console.log(err.response.data.error);
                        });
                }
            }
        },
    };
</script>

<style scoped>
  @import "https://use.fontawesome.com/releases/v5.8.2/css/all.css";
  div.peer{
    background-image: url("../../assets/theam/static/images/bg.jpg");
  }
  div.peer-login{
    background: white;
  }
    .btn-floating {
        position: relative;
        z-index: 1;
        display: inline-block;
        padding: 0;
        margin: 10px;
        overflow: hidden;
        vertical-align: middle;
        cursor: pointer;
        border-radius: 50%;
        -webkit-box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18), 0 4px 15px 0 rgba(0,0,0,0.15);
        box-shadow: 0 5px 11px 0 rgba(0,0,0,0.18), 0 4px 15px 0 rgba(0,0,0,0.15);
        -webkit-transition: all .2s ease-in-out;
        transition: all .2s ease-in-out;
        width: 47px;
        height: 47px;
    }
    .btn-floating.btn-lg {
        width: 61.1px;
        height: 61.1px;
        font-size: 1.25rem;
        line-height: 1.5;
    }
    .btn-fb {
        color: #fff;
        background-color: #3b5998 !important;
    }
    .btn-floating i {
        display: inline-block;
        width: inherit;
        color: #fff;
        text-align: center;
        font-size: 1.625rem;
        line-height: 61.1px;
        font-family: "Font Awesome 5 Brands";
    }

    .btn-tw {
        color: #fff;
        background-color: #55acee !important;
    }
    .btn-gplus {
        color: #fff;
        background-color: #dd4b39 !important;
    }
    .btn-git {
        color: #fff;
        background-color: #333 !important;
    }
</style>
