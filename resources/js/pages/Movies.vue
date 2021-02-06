<template>
    <div class="movies" v-if="topMovies">
        <div class="movies-wrapper">
            <MovieBlock v-for="(item, index) in topMovies"
                        :key="index"
                        :id="item.id"
                        :title="item.title"
                        :rating="item.rating"
                        :year="item.year"
                        :image="item.poster"></MovieBlock>
        </div>
    </div>
</template>

<script>
import MovieBlock from "../components/MovieBlock";
import {mapActions, mapState} from "vuex";
export default {
    mounted(){
        this.setTopMovies();
    },
    components:{
        MovieBlock
    },
    methods: {
        ...mapActions('movie', ['setTopMovies'])
    },
    computed:{
        ...mapState('movie', ['topMovies'])
    }
}
</script>
