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
            await axios.get(`/api/movies/top`)
                .then(async (response) => {
                    await commit('SET_TOP_MOVIES_STATE', response.data);
                });
        },
        setMovie: async function ({commit}, id) {
            await axios.get(`/api/movies/${id}`)
                .then(async (response) => {
                    await commit('SET_MOVIE_STATE', response.data);
                });
        }
    },
    mutations: {
        SET_TOP_MOVIES_STATE(state, payload) {
            state.topMovies = payload;
        },
        SET_MOVIE_STATE(state, payload) {
            state.movie = payload;
        }
    }
};
