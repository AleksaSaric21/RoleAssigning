import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import Vuex from 'vuex';
import Store from './store';
import {hasRole} from "./helpers";

window.axios = require('axios');

Vue.use(Vuex);
Vue.use(VueRouter);
const router = new VueRouter(routes);


router.beforeEach((to,from,next)=>{
    const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
    const currentUser = Store.state.currentUser;
     console.log(currentUser);
    if (requiresAuth && !currentUser){
        next('login');
    }

    else if (to.path == '/admin' && !hasRole(currentUser.roles,'Admin')){
        next('/');
    }
    else if (to.path == '/login' && currentUser){
        next('/');
    } else {
        next();
    }

});

const app = new Vue({
    el: '#app',
    router,
    store: new Vuex.Store(Store),
});
