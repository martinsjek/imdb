<template>
    <div class="movie" v-if="movie">
        <h2>{{movie.title}}</h2>
        <div class="container">
            <div class="movie-data">
                <div class="image">
                    <img :src="movie.poster" :alt="movie.title">
                </div>
                <div class="data">
                    <p class="ranking">Ranking: {{movie.ranking}}</p>
                    <p class="year">Year: {{movie.year}}</p>
                    <p class="rating">Rating: {{movie.rating}}</p>
                </div>
            </div>
            <div class="comments">
                <h3>Comments</h3>
                <form action="" @submit.prevent="submitComment">
                    <div class="form-item">
                        <label for="name">Name</label>
                        <input id="name" type="text" v-model="name">
                        <p class="error" v-if="commentsErrors && commentsErrors.name">
                            <span v-for="(item, index) in commentsErrors.name">{{item}}</span>
                        </p>
                    </div>
                    <div class="form-item">
                        <label for="comment">Comment</label>
                        <textarea id="comment" v-model="comment"></textarea>
                        <p class="error" v-if="commentsErrors && commentsErrors.comment">
                            <span v-for="(item, index) in commentsErrors.comment">{{item}}</span>
                        </p>
                    </div>
                    <button type="submit">Submit</button>
                </form>

                <div class="all-comments" v-if="comments && comments.length">
                    <h3>All comments ({{comments.length}})</h3>
                    <div class="comment" v-for="(item, index) in comments">
                        <p class="name">{{item.name}}</p>
                        <p class="text">{{item.comment}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapState} from "vuex";

export default {
    data(){
      return {
          name: '',
          comment: ''
      }
    },
    mounted(){
        this.setMovie(this.$route.params.id);
    },
    methods: {
        ...mapActions('movie', ['setMovie', 'postComment']),

        submitComment(){
            this.postComment([this.$route.params.id, {
                name: this.name,
                comment: this.comment
            }])
        }
    },
    computed:{
        ...mapState('movie', ['movie', 'comments', 'commentsErrors'])
    }
}
</script>

<style lang="scss">
    .movie{
        margin: 30px 0;
        h2{
            text-align: center;
        }
        .movie-data{
            display: flex;
            align-items: flex-start;
            flex-wrap: wrap;
        }
        .data{
            margin-left: 30px;
        }
        .comments{
            width: 100%;
            margin-top: 40px;
        }
        .form-item{
            margin: 20px 0;
        }

        button{
            background: white;
            outline:none;
            border:1px solid black;
            padding:10px 30px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .all-comments{
            margin-top: 30px;
        }

        .comment{
            border-radius: 4px;
            border: 1px solid #666;
            padding:20px;
            margin: 20px 0;
            .name{
                font-weight: bold;
            }
        }
        .error{
            color: red;
            span{
                display: block;
                width: 100%;
            }
        }
    }
</style>
