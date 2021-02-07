<template>
    <router-link :to="`/${id}`" class="movie-block">
        <div class="image">
            <img :src="image" :alt="title">
        </div>
        <p class="title">{{title}}</p>
        <p class="year">Year: {{year}}</p>
        <p class="rating">Rating: {{rating}}</p>
        <p class="rating">Comments: {{comments}}</p>
    </router-link>
</template>

<script>
export default {
    props:{
        id:Number,
        image: String,
        title: String,
        year: Number,
        rating: Number,
        comments: Number
    }
}
</script>

<style lang="scss">
    .movie-block{
        box-shadow: 0 0 4px 0;
        border-radius: 4px;
        padding: 10px;
        color: black;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-decoration: none;
    }
</style>
