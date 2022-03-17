<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ["code"=> "Business", "description" => "Descrizione Business"],
            ["code"=> "Shopping", "description" => "Descrizione Shopping"],
            ["code"=> "News", "description" => "Descrizione News"],
            ["code"=> "Salute", "description" => "Descrizione Salute "],
            ["code"=> "Calcio", "description" => "Descrizione Calcio"],
            ["code"=> "Regione", "description" => "Descrizione Regione"]
          ];
      
          foreach ($categories as $category) {
            $newCat = new Category();
            // $newCat->code = $category["code"];
            // $newCat->description = $category["description"];
            $newCat->fill($category);
            $newCat->save();
      
            // Category::create($category);
          }
    }
}
