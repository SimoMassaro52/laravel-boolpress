<template>
    <main class="box p-5">

        <!-- Cicliamo i titoli dei post con il vecchio v-for di vue -->
        <div class="container">
            <div class="row justify-content-center">
                <div v-for="(post,index) in posts" :key="index" class="post d-flex flex-column justify-content-center">
                    <!-- Se presente l'immagine, la stampiamo -->
                    <img v-if="post.image" :src="`/storage/${post.image}`" :alt="post.title" class="c-image img-fluid m-3">
                    <div class="text-box p-2">
                        <h3 class="title">{{post.title}}</h3>
                        <!-- Il post potrebbe non avere una category, quindi usiamo un v-if -->
                        <div v-if="post.category" class="category my-1">{{post.category.name}}</div>
                        <ul class="tags">
                            <li v-for="tag in post.tags" :key="tag.slug" class="tag">{{tag.name}}</li>
                        </ul>
                        <p class="content">{{post.content}}</p>
                    </div>    
                    <!-- Link per visualizzare il singolo post -->
                    <router-link :to="{name: 'single-post', params:{slug: post.slug}}">View post</router-link>
                </div>
            </div>    
        </div>
    </main>
</template>

<script>
export default {
    name: "Main",
    data(){
        return{
            posts:[]
        }
    },
    created(){
        // Per eseguire la chimata axios basta scrivere la url dell'api
        axios.get("/api/posts").then((rispApi)=>{
            this.posts = rispApi.data;
        })
    }
}
</script>

<style lang="scss" scoped>
        // *{
        //     border: 1px solid black;
        // }

        .box{
            background-color: #FFFF;
            font-family: 'Kanit', sans-serif;
            // 
            .post{
                background-color: #FFFF64;
                border: 5px solid #121212;
                width: calc(100% /4);
                margin: 10px;
                min-height: 370px;
                box-shadow: 6px 6px 8px 0px rgba(0,0,0,0.39);
                .c-image{
                    border: 5px solid #121212;
                }
                .text-box{
                    min-height: 200px;
                    .title{
                        color: #121212;     
                        font-weight: bold;
                        text-decoration: underline;
                    }
                    .category{
                        background-color: white;
                        text-transform: uppercase;
                        color: black;
                        // text-shadow: 1px 2px 0px #000000;
                        border: 3px solid black;
                        display: inline-block;
                        padding: 1px 5px;
                        font-size: 18px;
                    }
                    .tags{
                        list-style: none;
                        padding: 0px !important;
                        .tag{
                            background-color: white;
                            color: #121212;
                            display: inline-block;
                            padding: 2px 4px;
                            font-size: 11px;
                            margin:0px 2px;
                        }
                    }
                }
            }
        }
</style>