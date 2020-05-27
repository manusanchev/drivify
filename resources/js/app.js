/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/headerComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('header-component', require('./components/headerComponent.vue').default);
Vue.component('footer-component', require('./components/footerComponent.vue').default);
Vue.component('profile-data', require('./components/profileData.vue').default);
Vue.component('choose-songs', require('./components/chooseSongs.vue').default);



Vue.component('home', require('./views/home.vue').default);
Vue.component('profile', require('./views/profile.vue').default);
Vue.component('travel', require('./views/travel.vue').default);
Vue.component('travel-conductor', require('./views/travelConductor.vue').default);
Vue.component('travel-ocupante', require('./views/travelOcupante.vue').default);
Vue.component('choose-song-conductor', require('./views/chooseSongConductor.vue').default);
Vue.component('choose-song-ocupante', require('./views/chooseSongOcupante.vue').default);
Vue.component('your-travels', require('./views/yourTravels.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import router from "./routes";
import Notifications from 'vue-notification';
Vue.use(Notifications);
const app = new Vue({
    el: '#app',
    router
});

