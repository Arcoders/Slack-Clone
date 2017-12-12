
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import BootstrapVue from 'bootstrap-vue';
import Avatar from 'vue-avatar';
import VueChatScroll from 'vue-chat-scroll';

const VueResource = require('vue-resource');
const VueMoment = require('vue-moment');
const VuePusher = require('vue-pusher');

window.Vue.use(VueResource);
window.Vue.use(BootstrapVue);
window.Vue.use(VueRouter);
window.Vue.use(VueMoment);
window.Vue.use(VueChatScroll);

window.Vue.use(VuePusher, {
    api_key: '60efd870de38efff2291',
    options: {
        cluster: 'eu',
        encrypted: true,
    }
});

let content = document.getElementById('csrf-token').getAttribute('content');
Vue.http.headers.common['X-CSRF-TOKEN'] = content;
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('vue-simple-spinner', require('./components/spinner/spinner.vue'));
Vue.component('avatar', Avatar);

import chat_box from './components/chatBox/chatbox.vue';
import add_rooms from './components/rooms/add_rooms.vue';
import all_rooms from './components/rooms/all_rooms.vue';
import private_rooms from './components/rooms/private_rooms.vue';
import my_rooms from './components/rooms/my_rooms.vue';
import my_profile from './components/profiles/my_profile.vue';
import friend from './components/users/friend.vue';
import user_profile from './components/profiles/user_profile.vue';

const router = new VueRouter({
    routes: [
        { path: '/', component: all_rooms },
        { path: '/myprofile', component: my_profile },
        { path: '/addrooms', component: add_rooms },
        { path: '/allrooms', component: all_rooms },
        { path: '/myrooms', component: my_rooms },
        { path: '/private', component: private_rooms },
        { path: '/friend', component: friend },
        { path: '/user/:user_id/:user_name', component: user_profile, name: 'userProfile' },
        { path: '/room/:room_id/:room_name', component: chat_box, name: 'chatbox' },
        { path: '/private/room_id', component: chat_box, name: 'privatebox' }
    ]
});

new Vue({
    router,
}).$mount('#app');
