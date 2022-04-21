<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class bannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $banner = banner::all();
        return view('banner.banner')->with('banner',$banner);
    }
    public function addbanner(Request $request)
    { 
        $validation = Validator::make($request->all(),[
            'gambar_banner' => 'max:2000',
            
            
    
    
         ]);
         if ($validation->fails()) {
            return redirect('/banner')->with('warning', 'Ukuran gambar terlalu besar');
         }

        $fileextension = $request->file('gambar_banner')->getClientOriginalExtension();
        $filename = time().".". $fileextension;
        $request->file('gambar_banner')->move(public_path('/uploadbanner'), $filename); 

        $banner = new banner;
        $banner->deskripsi_banner = 'info kamu';
        $banner->gambar_banner =asset("uploadbanner/$filename");
        $banner->save();
        
        return redirect('/banner')->with('success', 'Berhasil Menambahkan banner');
    }
    // public function updatefaq(Request $request, $id)
    // {
   
    //     $banner = banner::find($id);
    //     $banner->judul_faq = $request->input('judul_faq');
    //     $banner->deskripsi_faq = $request->input('deskripsi_faq');
    //     $banner->save();
        
    //     return redirect('/faq')->with('success', 'Berhasil update faq');
    // }
    public function deletebanner(Request $request, $id)
    {
   
        $banner = banner::find($id);
        
        $banner->delete();
        
        return redirect('/banner')->with('success', 'Berhasil Delete banner');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(banner $banner)
    {
        //
    }
}
