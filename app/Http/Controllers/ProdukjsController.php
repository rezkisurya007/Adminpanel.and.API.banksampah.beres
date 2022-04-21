<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produkjs;
use Illuminate\Support\Facades\Validator;


class ProdukjsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        
        $produkjs = produkjs::where('js_is_delete',0)->get();
        
       
        // with('customer')->where('id_customer_transaksi',$customer->customer_id)->get();
        
        return view('produkjs.produkjs')->with('produkjs',$produkjs);
    }
    public function addprodukjs(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'gambar_js' => 'max:2000',
            
            
    
    
         ]);
         if ($validation->fails()) {
            return redirect('/produkjs')->with('warning', 'Ukuran gambar terlalu besar');
         }
        
        $fileextension = $request->file('gambar_js')->getClientOriginalExtension();
        $filename = time().".". $fileextension;
        $request->file('gambar_js')->move(public_path('/uploadprodukjs'), $filename); 
        
        $produkjs = new produkjs;
        $produkjs->gambar_js = asset("uploadprodukjs/$filename"); 
        $produkjs->judul_js = $request->input('judul_js'); 
        $produkjs->deskripsi_js = $request->input('deskripsi_js');
        $produkjs->harga_js = $request->input('harga_js');
        $produkjs->satuan_js = $request->input('satuan_js');

        $produkjs->save();
        
        return redirect("/produkjs")->with('success', 'Berhasil Menambahkan produk jual sampah');
    }
    public function updateprodukjs(Request $request,$id)
    {
        $validation = Validator::make($request->all(),[
            'gambar_js' => 'max:2000',
            
            
    
    
         ]);
         if ($validation->fails()) {
            return redirect('/produkjs')->with('warning', 'Ukuran gambar terlalu besar');
         }
         
        if ($request->file('gambar_js')) {
            $fileextension = $request->file('gambar_js')->getClientOriginalExtension();
        $filename = time().".". $fileextension;
        $request->file('gambar_js')->move(public_path('/uploadprodukjs'), $filename); 
        
        $produkjs = produkjs::find($id);
        $produkjs->gambar_js = asset("uploadprodukjs/$filename"); 
        $produkjs->judul_js = $request->input('judul_js'); 
        $produkjs->deskripsi_js = $request->input('deskripsi_js');
        $produkjs->harga_js = $request->input('harga_js');
        $produkjs->satuan_js = $request->input('satuan_js');

        $produkjs->save();
        }else {
            $produkjs = produkjs::find($id);
            $produkjs->judul_js = $request->input('judul_js'); 
            $produkjs->deskripsi_js = $request->input('deskripsi_js');
            $produkjs->harga_js = $request->input('harga_js');
            $produkjs->satuan_js = $request->input('satuan_js');
    
            $produkjs->save();
        }
        
        
        return redirect("/produkjs")->with('success', 'Berhasil Update produk');
    }
    public function deleteprodukjs($id)
    {
    $js = produkjs::find($id);
    $js->js_is_delete = 1;
    $js->save();
        
        return redirect("/produkjs")->with('success', 'Berhasil Update produk');
    }
}
