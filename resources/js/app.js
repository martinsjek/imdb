require('./bootstrap');
import Vue from "vue";
import App from "./App";
import { store } from './store/store';
import { routes } from './routes';

export const router = new VueRouter({
    mode: 'history',
    routes
});


new Vue({
    el: '#app',
    store:store,
    template: '<App />',
    components: { App },
    router
})


