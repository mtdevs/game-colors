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
        \App\User::create([
            'name' => 'Muhammed Tepe',
            'email' => 'test@email.com',
            'password' => \Illuminate\Support\Facades\Hash::make('test1234')
        ]);
    }
}
