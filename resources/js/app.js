require('./bootstrap');
import Vue from "vue";
import App from "./App";
import VueRouter from "vue-router";
import { store } from './store/store';
import { routes } from './routes';

export const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.use(VueRouter);


new Vue({
    el: '#app',
    store:store,
    template: '<App />',
    components: { App },
    router
})


