<template>
    <div class="movie">
        <div class="image">
            <img :src="movie.poster" :alt="movie.title">
        </div>
        <p class="title">{{movie.title}}</p>
        <p class="year">{{movie.year}}</p>
        <p class="rating">{{movie.rating}}</p>
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
