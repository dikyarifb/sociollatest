<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            'name' => 'News',
            'slug' => 'news',
        ]);
        DB::table('tags')->insert([
            'name' => 'Politic',
            'slug' => 'politic',
        ]);
        DB::table('tags')->insert([
            'name' => 'Entertainment',
            'slug' => 'entertainment',
        ]);
        DB::table('tags')->insert([
            'name' => 'Sport',
            'slug' => 'sport',
        ]);
    }
}
