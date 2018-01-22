<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configuration')->insert([
            'name' => 'ADMIN_EMAIL',
            'value' => 'hardik@hardiksolanki.in,hardik@itinnovator.co',
        ]);

        DB::table('configuration')->insert([
            'name' => 'SITE_URL',
            'value' => 'test.com',
        ]);

        DB::table('configuration')->insert([
            'name' => 'SSL',
            'value' => 1,
        ]);

        DB::table('configuration')->insert([
            'name' => 'CACHE',
            'value' => 1,
        ]);

        DB::table('configuration')->insert([
            'name' => 'MAINTENANCE',
            'value' => 1,
        ]);

        DB::table('configuration')->insert([
            'name' => 'DEBUG_MODE',
            'value' => 1,
        ]);
    }
}
