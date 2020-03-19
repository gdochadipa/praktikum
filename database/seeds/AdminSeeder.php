<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'password' =>  Hash::make('ada123'),
            'name' => 'Admin Marketplace',
            'profile_image' => 'ada',
            'phone' => '08539545781'
        ]);
    }
}
