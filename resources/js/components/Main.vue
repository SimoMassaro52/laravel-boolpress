<template>
    <div>
        <ol>
            <!-- Cicliamo i titoli dei post con il vecchio v-for di vue -->
            <li v-for="(post, index) in posts" :key="index">
                <h2>{{post.title}}</h2>
                <p>{{post.content}}</p>
            </li>
        </ol>
        <h1>CIAO</h1>
    </div>
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

</style>