<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     DB::table('users')->insert([
            'name' => 'test1',
            'email' => 'kento@icloud.com',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
    
    
     DB::table('users')->insert([
            'name' => 'test2',
            'email' => 'kento2@icloud.com',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
        
     DB::table('users')->insert([
            'name' => 'test3',
            'email' => 'kento3@icloud.com',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
        
        DB::table('users')->insert([
            'name' => 'test4',
            'email' => 'kento4@icloud.com',
            'password' => Hash::make('12345678'),
            'remember_token' => Str::random(10),
        ]);
    }   
}
