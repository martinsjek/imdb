require('./bootstrap');
import Vue from "vue";
import App from "./App";
import VueRouter from "vue-router";
import { store } from './store/store';
import { routes } from './routes';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

export const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.use(VueRouter);

Vue.component('font-awesome-icon', FontAwesomeIcon);

new Vue({
    el: '#app',
    store:store,
    template: '<App />',
    components: { App },
    router
})


