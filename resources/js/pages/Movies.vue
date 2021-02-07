<template>
    <div class="movies" v-if="topMovies">
        <h2>IMDB TO MOVIES</h2>
        <div class="container">
            <div class="movies-wrapper">
                <MovieBlock v-for="(item, index) in topMovies"
                            :key="index"
                            :id="item.id"
                            :title="item.title"
                            :rating="item.rating"
                            :year="item.year"
                            :image="item.poster"></MovieBlock>
            </div>
            <div class="pagination" v-if="pageCount">
                <div @click="changePage(page - 1)" class="item prev" v-if="page > 1">
                    <font-awesome-icon icon="arrow-left"/>
                </div>
                <div class="item" v-for="(item, index) in pages()" :key="index" @click="changePage(item)"
                     :class="item === page ? 'active' : ''">
                    {{ item }}
                </div>
                <div @click="changePage(page + 1)" class="item next" v-if="page < pageCount">
                    <font-awesome-icon icon="arrow-right"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {faArrowLeft, faArrowRight} from '@fortawesome/free-solid-svg-icons'
import {library} from '@fortawesome/fontawesome-svg-core'
import MovieBlock from "../components/MovieBlock";
import {mapActions, mapState} from "vuex";

library.add(faArrowLeft)
library.add(faArrowRight)


export default {
    data() {
        return {
            showPagesInPagination: 5
        }
    },
    mounted() {
        this.setTopMovies(this.$route.query.page ?? null);
    },
    components: {
        MovieBlock
    },
    methods: {
        ...mapActions('movie', ['setTopMovies']),

        pages() {
            let counter = 0;
            let returnData = [];
            let half = Math.ceil(this.showPagesInPagination / 2);

            for (let i = 1; i <= this.pageCount; i++) {
                if (i - half <= this.page && i + half >= this.page && counter <= this.showPagesInPagination) {
                    returnData.push(i);
                    counter++;
                }
            }

            return returnData;
        },
        changePage(page) {
            this.$router.push({
                path: this.$route.path, query: {
                    page: page
                }
            })
        }
    },
    computed: {
        ...mapState('movie', ['topMovies', 'page', 'pageCount'])
    }
}
</script>

<style lang="scss">
.movies {
    h2 {
        text-align: center;
    }

    .movies-wrapper {
        display: flex;
        align-items: flex-start;
        flex-wrap: wrap;
        @media (min-width: 576px){
            margin-left: -30px;
        }
    }

    .movie-block {
        width: 100%;
        margin-bottom: 20px;
        @media (min-width: 576px){
            width: calc(100% / 2 - 30px);
            margin-left: 30px;
        }
        @media (min-width: 992px){
            width: calc(100% / 4 - 30px);
        }
    }
    .pagination{
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px 0;
        font-size: 30px;
        .item{
            margin:0 10px;
            cursor: pointer;
            &.active{
                color: green;
            }
        }
    }
}
</style>
