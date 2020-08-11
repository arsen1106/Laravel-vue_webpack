import VueRouter from 'vue-router';

import Home from '../components/unauthorized/HomeComponent.vue';
import Login from '../components/unauthorized/LoginComponent.vue';
import Register from '../components/unauthorized/RegisterComponent.vue';
import ResetPassword from "../components/unauthorized/ResetPasswordComponent";

import Users from '../components/templates/user/index';
import ViewUser from "../components/templates/user/view";
import EditUser from "../components/templates/user/edit";
import CreateUser from "../components/templates/user/create";

import ChatComponent from "../components/templates/chat/index";
import ContactUsComponent from "../components/templates/contact-us/index";

const routes = [
  {
    name: 'Home', path: '/', component: Home,
    beforeEnter: (to, from, next) => {
      if( window.Vue.auth.check()){
        let path = window.Vue.auth.check('-1') ? '/dashboard' : '/profile';
        return next(path)
      }
      return next('/login');
    },
  },

  { name: 'login', path: '/login', component: Login, meta:{ auth:false} },
  { name: 'login', path: '/login/:token/',component: Login, meta:{ auth:false } },
  { name: 'register', path: '/register', component: Register, meta:{ auth:false } },
  { name: 'reset', path: '/reset/password', component: ResetPassword, meta:{ auth:false } },

  // ADMIN ROUTES
  { name: 'Dashboard' , path: '/dashboard',
    meta: {
      auth: {roles: ['-1'], redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },

  { name: 'Profile', path: '/profile',
    meta: {
      auth: {
        roles: ['0','1'],
        forbiddenRedirect: '/dashboard'
      },
    }
  },

  { name: 'Users', path: '/users', component: Users,
    meta: {
      auth: {
        roles: ['-1'],
        forbiddenRedirect: '/403'
      },
    }
  },

  { name: 'user.view',  path: '/users/view/:id',component: ViewUser, meta:{ auth:true } },
  { name: 'user.edit',  path: '/users/edit/:id',component: EditUser, meta:{ auth:true } },
  { name: 'user.create',  path: '/users/create',component: CreateUser, meta:{ auth:true } },

  { name: 'Chat', path: '/chat', component: ChatComponent,
    meta: {
      auth: {
        roles: ['0','-1'],
        forbiddenRedirect: '/403'
      },
    }
  },

  { name: 'Contact-Us', path: '/contact-us', component: ContactUsComponent,
    meta: {
      auth: {
        roles: ['-1'],
        forbiddenRedirect: '/403'
      },
    }
  },
  { name: 'Contact', path: '/contact', component: ContactUsComponent,
    meta: {
      auth: {
        roles: ['0'],
        forbiddenRedirect: '/403'
      },
    }
  },
];
const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
});

router.beforeEach((to, from, next) => {
  if (!to.matched.length) {
    next(from.path);
  } else {
    next();
  }
});
export default router
