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
        DB::table('admin_users')->insert([
            'name' => 'Jigesh Raval',
            'email' => 'jigeshraval89@gmail.com',
            'password' => bcrypt('ravalera1'),
			'mobile' => '7405282053',
        ]);
    }
}
