<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'slug' => 'trainings',
            'name' => 'Тренінги',
            'order' => 1,
            'created_at' => Carbon\Carbon::now(),
        ]);

        DB::table('categories')->insert([
            'slug' => 'webinars',
            'name' => 'Вебінари',
            'order' => 2,
            'created_at' => Carbon\Carbon::now(),
        ]);

        DB::table('categories')->insert([
            'slug' => 'training-materials',
            'name' => 'Учбовий матеріал',
            'order' => 3,
            'created_at' => Carbon\Carbon::now(),
        ]);

        DB::table('categories')->insert([
            'slug' => 'testing',
            'name' => 'Тестування',
            'order' => 4,
            'created_at' => Carbon\Carbon::now(),
        ]);

    }
}
