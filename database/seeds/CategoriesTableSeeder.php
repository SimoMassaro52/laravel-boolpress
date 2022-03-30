<?php

use Illuminate\Database\Seeder;
//Ricordiamoci sempre di fare lo use su qualchiasi operazione esistente fuori dal seeder
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creiamo un array contente le nostre stringhe delle categorie
        $categories = ['movies', 'cars', 'food', 'sports'];
        foreach ($categories as $category_name) {
            $new_category = new Category();
            $new_category->name = $category_name;
            $new_category->slug = Str::of($category_name)->slug("-");
            $new_category->save();
        }
    }
}
