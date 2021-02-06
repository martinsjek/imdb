<template>
    <div class="movie-block">
        <div class="image">
            <img :data-src="image" src="" :alt="title">
        </div>
        <p class="title">{{title}}</p>
        <p class="year">{{year}}</p>
        <p class="rating">{{rating}}</p>
    </div>
</template>

<script>
export default {
    props:{
        image: String,
        title: String,
        year: Number,
        rating: Number
    }
}
</script>
