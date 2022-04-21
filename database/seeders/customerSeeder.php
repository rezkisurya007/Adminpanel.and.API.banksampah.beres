<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\customer;
use Illuminate\Support\Facades\Hash;

class customerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        customer::insert([[ 
        'id_customer'=>12034,
        'id_kecamatan_customer'=>1,
        'nama_customer'=>'Hakim',
        'alamat_customer'=>'jalan hahaha',
        'saldo_customer'=>20000,
        'pin_customer'=>Hash::make('1234'),
        'no_hp_customer'=>0,
        'role_customer'=>'customer',
    ],[
        'id_customer'=>12000,
        'id_kecamatan_customer'=>1,
        'nama_customer'=>'Sembako',
        'alamat_customer'=>'jalan hahaha',
        'saldo_customer'=>200000,
        'pin_customer'=>Hash::make('1234'),
        'no_hp_customer'=>0,
        'role_customer'=>'toko',
    ],

           
        ]);
    }
}
