<?php

use Illuminate\Database\Seeder;

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
            'name' => 'admin',
            'email' => 'admin@mc-sv1.enjoyprice.in.th',
            'password' => bcrypt('123456'),
            'group_id' => 1
        ]);
    }
}
