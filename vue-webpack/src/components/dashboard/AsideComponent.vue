<template>
  <div class="sidebar">
    <div class="sidebar-inner">
      <!-- ### $Sidebar Header ### -->
      <div class="sidebar-logo">
        <div class="peers ai-c fxw-nw">
          <div class="peer peer-greed">
            <a class="sidebar-link td-n" href="index.html">
              <div class="peers ai-c fxw-nw">
                <div class="peer">
                  <div class="logo">
                    <img src="../../assets/theam/static/images/logo.png" alt="">
                  </div>
                </div>
                <div class="peer peer-greed">
                  <h5 class="lh-1 mB-0 logo-text">Adminator</h5>
                </div>
              </div>
            </a>
          </div>
          <div class="peer">
            <div class="mobile-toggle sidebar-toggle">
              <a href="" class="td-n">
                <i class="ti-arrow-circle-left"></i>
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- ### $Sidebar Menu ### -->
        <NavItemComponent :items="routes"></NavItemComponent>
    </div>
  </div>
</template>

<script>
    import NavItemComponent from "./items/NavItemComponent";
    export default {
      name: "AsideComponent",
      components: {NavItemComponent},
      data(){
          return {
            routes:[
              { name:'Users' , path:'/dashboard/users' , role:'users' , icon:'c-blue-500 ti-home' ,type:['-1']},
              { name:'Contact' , path:'/profile/contact' , role:'contact' , icon:'c-brown-500 ti-email' ,type:['0']},
              { name:'Contact-Us' , path:'/dashboard/contact-us' , role:'contacts' , icon:'c-blue-500 ti-home' ,type: ['-1']},
              { name:'Chat' , path:'/profile/chat' , role:'contacts' , icon:'c-blue-500 ti-home' ,type:['0']},
            ],
          }
      },
    }
</script>

<style scoped>

</style>
