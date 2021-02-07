<template>
    <div class="movie">
        <h2>{{movie.title}}</h2>
        <div class="container">
            <div class="image">
                <img :src="movie.poster" :alt="movie.title">
            </div>
            <div class="data">
                <p class="ranking">Ranking: {{movie.ranking}}</p>
                <p class="year">Year: {{movie.year}}</p>
                <p class="rating">Rating: {{movie.rating}}</p>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";

export default {
    mounted(){
        this.setMovie(this.$route.params.id);
    },
    methods: {
        ...mapActions('movie', ['setMovie'])
    },
    computed:{
        ...mapState('movie', ['movie'])
    }
}
</script>

<style lang="scss">
    .movie{
        h2{
            text-align: center;
        }
        .container{
            display: flex;
            align-items: flex-start;
            flex-wrap: wrap;
        }
        .data{
            margin-left: 30px;
        }
    }
</style>
