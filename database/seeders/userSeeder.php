<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'id_kecamatan_user' => 1,
                'email' => 'superadmin@gmail.com',
                'name' => 'superadmin',
                'password' => Hash::make('12341234'),
                'role' => 'superadmin',
                
            ],
            [
                'id_kecamatan_user' => 1,
                'email' => 'admin@gmail.com',
                'name' => 'admin',
                'password' => Hash::make('12341234'),
                'role' => 'admin',
                
            ],[
                'id_kecamatan_user' => 1,
                'email' => 'adminppob@gmail.com',
                'name' => 'adminppob',
                'password' => Hash::make('12341234'),
                'role' => 'adminppob',
                
            ],
            
        ]);
    }
}
