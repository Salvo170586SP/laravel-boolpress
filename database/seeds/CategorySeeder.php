<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $categories = [
           ['label'=>'Html', 'color' => 'danger'],
           ['label'=>'Css', 'color' => 'info'],
           ['label'=>'Es6', 'color' => 'warning'],
           ['label'=>'Bootstrap', 'color' => 'purple'],
           ['label'=>'Php', 'color' => 'primary'],
           ['label'=>'Sql', 'color' => 'secondary'],
           ['label'=>'Laravel', 'color' => 'danger'],
           ['label'=>'VueJs', 'color' => 'success'],
       ];

       foreach($categories as $category){
           $new_category = new Category();
           $new_category->label = $category['label'];
           $new_category->color = $category['color'];
           $new_category->save();
        }
    }
}
