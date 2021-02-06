import Vue from "vue";
import vuex from 'vuex';
import axios from 'axios';

import movie from './Movie/store'

Vue.use(vuex, axios);

axios.defaults.withCredentials = true;

export const store =  new vuex.Store({
    namespaced: true,
    modules: {
        movie
    }
});

