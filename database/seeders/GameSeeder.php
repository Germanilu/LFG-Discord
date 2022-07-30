<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            'name'=> "Rust"
        ]);

        DB::table('games')->insert([
            'name'=> "CS:GO"
        ]);

        DB::table('games')->insert([
            'name'=> "Age of Empires"
        ]);

        DB::table('games')->insert([
            'name'=> "League of Legends"
        ]);

    }
}
