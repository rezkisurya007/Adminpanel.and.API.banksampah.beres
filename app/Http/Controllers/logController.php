<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\transaksippob;
use App\Models\transaksijs;
use App\Models\transfer;



class logController extends Controller
{
    public function index($id){
        
        $tpp = transaksippob::with('customer')->where('customer_ppob',$id)->get();
        $tjs = transaksijs::with('kecamatan')->with('customer')->with('produkjs')->where('id_cs_js',$id)->get();
        $transfer = transfer::with('customer')->where('pengirim',$id)->get();
        $merge = array_merge($tjs->toArray(),$tpp->toArray(),$transfer->toArray());
        $collect = collect($merge)->sortByDesc('created_at')->values()->all();
        // $tpp = transaksippob::all();
        // return view('ppob.ppob')->with('ppob',$ppob);
        return response()->json([
            'status' => 'success',
            'message' => 'data log bro',
            'data' => $collect,
        ]);
}
}
