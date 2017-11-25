
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import Spinner from 'vue-simple-spinner';
import BootstrapVue from 'bootstrap-vue';

const VueResource = require('vue-resource');
const VueMoment = require('vue-moment');

window.Vue.use(VueResource);
window.Vue.use(BootstrapVue);
window.Vue.use(VueRouter);
window.Vue.use(VueMoment);

let content = document.getElementById('csrf-token').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = content;
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('vue-simple-spinner', require('./components/spinner/spinner.vue'));


import chat_box from './components/chatBox/chatbox.vue';
import add_rooms from './components/rooms/add_rooms.vue';
import all_rooms from './components/rooms/all_rooms.vue';
import my_rooms from './components/rooms/my_rooms.vue';

const router = new VueRouter({
    routes: [
        { path: '/addrooms', component: add_rooms },
        { path: '/allrooms', component: all_rooms },
        { path: '/myrooms', component: my_rooms },
        { path: '/chat', component: chat_box }
    ]
});

new Vue({
    router,
    components: Spinner
}).$mount('#app');
