<?php

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
        DB::table('categories')->insert([
            'name' => 'awarie',
            'color' => '#fc2626',
        ]);

        DB::table('categories')->insert([
            'name' => 'ekspolatacyjne',
            'color' => '#ff930f',
        ]);

        DB::table('categories')->insert([
            'name' => 'opłaty',
            'color' => '#0f97ff',
        ]);
    }
}
