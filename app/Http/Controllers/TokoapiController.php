<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customer;

class TokoapiController extends Controller
{
    public function index(){
      
            $toko = customer::with('kecamatan')->get();
        // $kecamatan = kecamatan::all();
       return response()->json($toko);
        }
}
