<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => '44kowal@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'superadmin'
        ]);
    }
}
