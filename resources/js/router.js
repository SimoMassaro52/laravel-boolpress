// Script di gestione delle rotte vue

import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

//Cerca i componenti-pagina nella cartella sorella di components, pages
import Home from "./pages/Home";
import SinglePost from "./pages/SinglePost"
const router = new VueRouter({
    mode: "history",
    routes:[
        //Home
        {
            //A questa rotta...
            path:"/",
            //...carico questo componente
            name:"home",
            component: Home
        },
        //Sigle-post
        {
            //Impostiamo lo slug come indicatore di rotta per il post singolo, un po' come se scrivessimo {{$post->slug}} con Laravel
            path:"posts/:slug",
            name:"single-post",
            component: SinglePost
        }
    ]
});

export default router