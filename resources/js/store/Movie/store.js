import axios from 'axios';

export default {
    namespaced:true,
    state: {
        topMovies: null,
        movie: null,
        page: null,
        pageCount: null,
        comments: null,
        commentsErrors: null
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
        setTopMovies: async function ({commit}, page = '') {
            if(page){
                page = `?page=${page}`;
            }

            await axios.get(`/api/movies/top${page}`)
                .then(async (response) => {
                    await commit('SET_TOP_MOVIES_STATE', response.data.movies);
                    await commit('SET_PAGE_STATE', response.data.currentPage);
                    await commit('SET_PAGE_COUNT_STATE', response.data.lastPage);
                });
        },
        setMovie: async function ({commit}, id) {
            await axios.get(`/api/movies/${id}`)
                .then(async (response) => {
                    await commit('SET_MOVIE_STATE', response.data.movie);
                    await commit('SET_COMMENTS_STATE', response.data.comments);
                });
        },
        postComment: async function ({commit}, [id, data]) {
            await axios.post(`/api/movies/${id}/post-comment`, data)
                .then(async (response) => {
                    await commit('SET_COMMENTS_STATE', response.data.comments);
                    await commit('SET_COMMENTS_ERRORS_STATE', null);
                })
                .catch(async (error) => {
                    await commit('SET_COMMENTS_ERRORS_STATE', error.response.data.errors);
                });
        },
    },
    mutations: {
        SET_TOP_MOVIES_STATE(state, payload) {
            state.topMovies = payload;
        },
        SET_MOVIE_STATE(state, payload) {
            state.movie = payload;
        },
        SET_PAGE_STATE(state, payload) {
            state.page = payload;
        },
        SET_PAGE_COUNT_STATE(state, payload) {
            state.pageCount = payload;
        },
        SET_COMMENTS_STATE(state, payload) {
            state.comments = payload;
        },
        SET_COMMENTS_ERRORS_STATE(state, payload) {
            state.commentsErrors = payload;
        }
    }
};
