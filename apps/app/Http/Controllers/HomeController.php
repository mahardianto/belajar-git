<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//nambahi upload
use Storage;

//pake file
use File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

//belajar upload
     public function upload(Request $request)
    {

      $registrasi=$request->registrasi;
      if ($registrasi!=''){
        $this->validate($request, [
              'registrasi' => 'image',
              //'body' => 'required',
        ]);
        $body=$request->body;
        echo $body."<hr/>";
        //naruh file yang di upload di folder storage/app/public/registrasi
        $path=$request->file('registrasi')->store('public/registrasi');
        //$path=Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
        $contents = Storage::url($path);
        //pake URL
        echo asset($path)."<hr/>";
        //langsung directorynya
        echo "untuk menghapus ".$path."<hr/>";
        echo "untuk menampilkan link di img ".$contents."<hr/>";
        //nampilin imagenya
        echo '<img src="'.$contents.'"><hr />';
        //cara menghapus kontens
        //Storage::delete($path);
      }
      else {
      echo '<img src="storage/default/no-images.png"><hr />';
      }


    }
}
