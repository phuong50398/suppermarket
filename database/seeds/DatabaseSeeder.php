<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->dataCategory();
        factory(App\Model\Category::class, 70)->create();
        factory(App\Model\Producer::class, rand(5,10))->create();
        factory(App\Model\Provider::class, rand(5,10))->create();
        factory(App\Model\Product::class, 100)->create();
        factory(App\Model\Album::class, 300)->create();
    }
    public function dataCategory()
    {
        // factory(App\Model\CategoryGroup::class, 5)->create()->each(function ($ndm)
        // {
        //     $ndm->category()->saveMany(
        //         factory(App\Model\Category::class, 5)->make()
        //         // ->each(function ($dm)
        //         // {
        //         //     $dm->categoryType()->saveMany(
        //         //         factory(App\Model\CategoryType::class, rand(5,10))->make()
        //         //     );
        //         // })
        //     );

        // });
    }
}
