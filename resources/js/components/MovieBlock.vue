<template>
    <router-link :to="`/${id}`" class="movie-block">
        <div class="image">
            <img :src="image" :alt="title">
        </div>
        <p class="title">{{title}}</p>
        <p class="year">{{year}}</p>
        <p class="rating">{{rating}}</p>
    </router-link>
</template>

<script>
export default {
    props:{
        id:Number,
        image: String,
        title: String,
        year: Number,
        rating: Number
    }
}
</script>
