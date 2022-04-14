<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::where('name', 'root')->first();
        if(!$user){
            
            User::create([
                'name' => 'root',
                'email' =>'administrator@email.com',
                'password' => \Hash::make('password'),
                'email_verified_at' => now(),
                 'remember_token' => \Str::random(10),
               
    
            ]);
        }
    }
}
