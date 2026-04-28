<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Jan',
            'surname'=>'Kowalski',
            'email' => 'jan.kowalski@gmail.com',
            'role' => 'teacher',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Adam',
            'surname'=>'Milusiński',
            'email' => 'adam@gmail.com',
            'role' => 'user',
            'password' => bcrypt('secret'),
        ]);

        DB::table('users')->insert([
            'name' => 'Ambroży',
            'surname'=>'Cebula',
            'email' => 'ambrozy@gmail.com',
            'role' => 'user',
            'password' => bcrypt('cebula'),
        ]);

        DB::table('users')->insert([
            'name' => 'Brajan',
            'surname'=>'Socjalny',
            'email' => 'socjal@gmail.com',
            'role' => 'user',
            'password' => bcrypt('pincetplus'),
        ]);
    }
}
