<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        //Creiamo 10 post
        for ($i=0; $i < 10; $i++) { 
            $post = new Post();
            //words() crea n numero di parole e le restituisce come stringa, non array
            $post->title = $faker->words(4, true);
            $post->content = $faker->text();
            //Generazione slug: ci appoggiamo alla classe Str che elabora la stringa del titolo e sostituisce gli spazi con "-"
            $post->slug = Str::of($post->title)->slug("-");
            $post->published = rand(0, 1);
            $post->save();
        }
    }
}
