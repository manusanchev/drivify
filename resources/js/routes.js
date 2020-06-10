import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import home from "./views/home";
import profile from "./views/profile";
import travel from "./views/travel";
import travelConductor from "./views/travelConductor";
import travelOcupante from "./views/travelOcupante";
import chooseSongConductor from "./views/chooseSongConductor";
import chooseSongOcupante from "./views/chooseSongOcupante";
import yourTravels from "./views/yourTravels";
import yourTravelsDetails from "./views/yourTravelsDetails";
import awards from "./views/awards";
import adminUsers from "./views/adminUsers";
import adminTravels from "./views/adminTravels";
import adminDashboard from "./components/adminDashboard";
const routes =  [
    {
        path : '/home',
        name: 'home',
        component: home,
        props: true

    },
    {
        path:'/perfil',
        name:"perfil",
        component: profile,
        props: true
    },

    {
        path:'/viaje',
        component: travel,
        props: true
    },
    {
        path: '/viaje/conductor',
        component: travelConductor,
        props: true
    },
    {
        path: '/viaje/ocupante',
        component: travelOcupante,
        props: true
    },
    {
        path: '/viaje/conductor/elegir',
        name:"conductor-elegir",
        component: chooseSongConductor,
        props: true
    },
    {
        path: '/viaje/ocupante/elegir',
        component: chooseSongOcupante,
        props: true
    },
    {
        path: '/tusViajes',
        component:yourTravels,
        props: true,
    },
    {
        path: '/tusViajes/detalles',
        name:"details",
        component:yourTravelsDetails,
        props: true,
    },
    {
        path: '/logros',
        name:"logros",
        component:awards,
        props: true,
    },
    {
        path: '/admin/dashboard',
        component: adminDashboard,
        name:'admin',
        props: true,
        children: [
            {
              path: 'users',
              component: adminUsers,         
            },
             {
              path: 'travels',
              component: adminTravels,         
            }       
          ],
    },
   



]

const router = new VueRouter({
    routes,

    mode: 'history',


})

export default router;
