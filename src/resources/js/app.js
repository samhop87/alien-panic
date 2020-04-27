/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Multiselect from 'vue-multiselect'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('welcome', require('./components/Welcome.vue').default);
Vue.component('user-store', require('./components/UserStore').default);
Vue.component('landing', require('./components/Landing').default);
Vue.component('game-screen', require('./components/GameScreen').default);
Vue.component('timer', require('./components/Timer').default);
Vue.component('multiselect', Multiselect);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
