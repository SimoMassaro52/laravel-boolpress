<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creiamo un array contente le stringhe che vogliamo rendere tag
        $tags = ['funny', 'sad', 'active', 'joyful', 'reflective'];
        foreach ($tags as $tag_name) {
            $new_tag = new Tag();
            $new_tag->name = $tag_name;
            $new_tag->slug = Str::of($tag_name)->slug("-");
            $new_tag->save();
        }
    }
}
