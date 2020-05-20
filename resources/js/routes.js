import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import home from "./views/home";
import profile from "./views/profile";
import travel from "./views/travel";
import travelConductor from "./views/travelConductor";
import travelOcupante from "./views/travelOcupante";
import chooseSongConductor from "./views/chooseSongConductor";
const routes =  [
    {
        path : '/home',
        component: home,

    },
    {
        path:'/perfil',
        name:"perfil",
        component: profile,
        props: true
    },

    {
        path:'/viaje',
        component: travel
    },
    {
        path: '/viaje/conductor',
        component: travelConductor
    },
    {
        path: '/viaje/ocupante',
        component: travelOcupante
    },
    {
        path: '/viaje/conductor/elegir',
        component: chooseSongConductor
    },
    // {
    //     path: '/viajes/conductor/canciones-elegidas',
    //     component:choosedSongsConductor
    // },
    // {
    //     path: '/viajes/conductor/playlists',
    //     component:playlistConductor
    // }

]

const router = new VueRouter({
    routes,

    mode: 'history',


})

export default router;
