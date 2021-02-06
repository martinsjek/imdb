import axios from 'axios';

export default {
    namespaced:true,
    state: {
        topMovies: null,
        movie: null
    },
    getters: {
        getTopMovies(state) {
            return state.topMovies;
        },
        getMovie(state) {
            return state.movie;
        }
    },
    actions: {
        setTopMovies: async function ({commit}) {

        },
        setMovie: async function ({commit}, id) {

        }
    },
    mutations: {
        SET_TOP_MOVIES_STATE(state, payload) {
            state.products = payload;
        },
        SET_MOVIE_STATE(state, payload) {
            state.productsPageCount = payload;
        }
    }
};
