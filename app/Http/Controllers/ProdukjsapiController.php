<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produkjs;

class ProdukjsapiController extends Controller
{
    public function index(){
        
        $produkjs = produkjs::where('js_is_delete',0)->get();
        
       
        // with('customer')->where('id_customer_transaksi',$customer->customer_id)->get();
        
        return response()->json($produkjs);
    }
}
