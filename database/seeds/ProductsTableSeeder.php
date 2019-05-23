<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $product = new \App\Product();
        $product->nom = 'T-Shirt Goonies';
        $product->prix_ht = 25;
        $product->description = "T-Shirt du film les Goonies";
        $product->photo_principale = "goonies.jpg";
        $product->id_category = 1;
        $product->save();

        $product2 = new \App\Product();
        $product2->nom = 'T-Shirt M.Happy';
        $product2->prix_ht = 12;
        $product2->description = "T-Shirt qui rend heureux";
        $product2->photo_principale = "happy.jpg";
        $product2->id_category = 2;
        $product2->save();

        $product3 = new \App\Product();
        $product3->nom = 'T-Shirt Hulk';
        $product3->prix_ht = 19;
        $product3->description = "T-Shirt qui rend plus fort";
        $product3->photo_principale = "hulk.jpg";
        $product3->id_category = 1;
        $product3->save();

        $product4 = new \App\Product();
        $product4->nom = 'T-Shirt Krusty le clown';
        $product4->prix_ht = 17;
        $product4->description = "T-Shirt qui rend plus drole";
        $product4->photo_principale = "krusty_simpsons.jpg";
        $product4->id_category = 2;
        $product4->save();

        $product5 = new \App\Product();
        $product5->nom = 'T-Shirt Little Miss Sunshine';
        $product5->prix_ht = 13;
        $product5->description = "T-Shirt qui fait sourrire";
        $product5->photo_principale = "little_miss_sunshine.jpg";
        $product5->id_category = 2;
        $product5->save();

        $product6 = new \App\Product();
        $product6->nom = 'T-Shirt Simpsons';
        $product6->prix_ht = 25;
        $product6->description = "T-Shirt qui rend jaune";
        $product6->photo_principale = "simpsons.jpg";
        $product6->id_category = 4;
        $product6->save();

        $product7 = new \App\Product();
        $product7->nom = 'T-Shirt Star Trek Commandant Kirk';
        $product7->prix_ht = 15;
        $product7->description = "T-Shirt qui rend chelou";
        $product7->photo_principale = "star_trek_kirk.jpg";
        $product7->id_category = 4;
        $product7->save();

        $product8 = new \App\Product();
        $product8->nom = 'T-Shirt Super Man';
        $product8->prix_ht = 20;
        $product8->description = "T-Shirt qui rend indestructible";
        $product8->photo_principale = "super_man.jpg";
        $product8->id_category = 1;
        $product8->save();

        $product9 = new \App\Product();
        $product9->nom = 'T-Shirt Wonder Woman';
        $product9->prix_ht = 18;
        $product9->description = "T-Shirt qui rend femme";
        $product9->photo_principale = "wonder_woman.jpg";
        $product9->id_category = 2;
        $product9->save();
    }
}
