<?php

use Illuminate\Database\Seeder;
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
        $categories = ['Casa', 'Appartamento', 'Villa', 'Monolocale', 'Stanza', 'Chalet', 'Hotel'];

        foreach($categories as $category){
            $new_category = new Category();
            $new_category->name = $category;
            $new_category->slug = Category::generateSlug($category);
            $new_category->save();
        }
    }
}
