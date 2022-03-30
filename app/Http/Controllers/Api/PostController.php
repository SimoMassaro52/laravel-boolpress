<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Ovviamente, ricordiamoci di includere il model
use App\Post;

class PostController extends Controller
{
    public function index(){
        //Esempio response json
        // return response()->json([
        //     "name" => "John",
        //     "surname" => "Doe"
        // ]);
        
        // Stampiamo tutti i post nel json
        $posts = Post::all(); 
        return response()->json($posts);

        // //Stampiamo solo quelli con un category_id valorizzati grazie a ::where
        // $posts_filtered = Post::where("category_id", "!=", null)->get();
        // return response()->json($posts_filtered);

    }


}
