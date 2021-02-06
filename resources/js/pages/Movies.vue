<template>
    <div class="movies" v-if="topMovies">
        <div class="movies-wrapper">
            <MovieBlock v-for="(item, index) in topMovies"
                        :key="index"
                        :title="item.title"
                        :rating="item.rating"
                        :year="item.year"
                        :image="item.image"></MovieBlock>
        </div>
    </div>
</template>

<script>
import MovieBlock from "./Movie";
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
