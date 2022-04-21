<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\info;

class apiinfoController extends Controller
{
    public function index(){
        $info = info::all();
        return response()->json([
            'status' => 'success',
            'msg' => 'data info',
            'data' => $info ,
        ]);
    }
    public function info($id){
        $info = info::where('id_info',$id)->get();
        return response()->json([
            'status' => 'success',
            'msg' => 'data info',
            'data' => $info ,
        ]);
    }
}
