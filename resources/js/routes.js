import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import home from "./views/home";
import profile from "./views/profile";
const routes =  [
    {
        path : '/home',
        component: home,

    },
    {
        path:'/perfil',
        component: profile
    }

]

const router = new VueRouter({
    routes,

    mode: 'history',


})

export default router;
