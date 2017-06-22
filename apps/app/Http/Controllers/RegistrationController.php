<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon; //menambahkan fungsi waktu
use App\Register; //untuk komunikasi dengan model register
use Auth; //tambahkan untuk mengambil data session otentikasi
use App\City; //memasukkan skrip model City untuk komunikasi dengan tabel database cities
use App\Province; //memasukkan skrip model Provinsi untuk komunikasi dengan tabel database provinces
use Storage; //menambahkan fitur upload
use File; //menampilkan file
use App\Image;


class RegistrationController extends Controller
{
    //

        //menampilkan view index menu registrasi http://alamat_host/registrasi/
        public function index()
        {
      	//memasukkan hasil query dari model bernama "Register" ke variable registers
      	$registers = Register::orderBy('register_number', 'asc')->paginate(15);
        //mengirimkan data di variable registers dengan nama "data" ke view registrasi-list
      	return view('registrasi.registrasi-list', [
                'data' => $registers
              ]);
        }

        public function remove()
        {
      	//memasukkan hasil query dari model bernama "Register" ke variable registers
      	$registers = Register::orderBy('created_at', 'asc')->paginate(15);
        //mengirimkan data di variable registers dengan nama "data" ke view registrasi-list
      	return view('registrasi.registrasi-remove', [
                'data' => $registers
              ]);
        }

        //Fungsi untuk menampilkan form perubahan data
        public function edit($id)
        {
      	//memasukkan hasil query dari model bernama "Register" ke variable registers
      	$registers = Register::where('id', $id)->get();
        //mengirimkan data di variable registers dengan nama "data" ke view registrasi-edit
        $register = Register::findOrFail($id);
        $city_id = $register->city_id;
        $cities = City::orderBy('name', 'asc')->get();
        $provinces = Province::orderBy('name', 'asc')->get();
        $cara_perolehan=['Berlangganan','Download','Hibah','Peminjaman','Pembelian','Penggalian'];
      	return view('registrasi.registrasi-edit', [
                'provinces' => $provinces,
                'city_id' => $city_id,
                'cities' => $cities,
                'cara_perolehan' => $cara_perolehan,
                'data' => $registers
              ]);
        }


        public function detail($id)
        {
      	$registers = Register::where('id', $id)->get();
        $dataGambar = Register::findOrFail($id);
        $path=$dataGambar->gambar;
        if ($path !=''){
          $contents = Storage::url($path);
        }
        else {
          $contents="/storage/default/no-images.png";
        }
      	return view('registrasi.registrasi-detail', [
                'data' => $registers,
                'pict' => $contents
              ]);
        }

        //Fungsi untuk menampilkan confirm penghapusan data
        public function confirm($id)
        {
      	//memasukkan hasil query dari model bernama "Register" ke variable registers
      	$registers = Register::where('id', $id)->get();
        //mengambil path gambar
        $dataGambar = Register::findOrFail($id);
        $path=$dataGambar->gambar;
        if (!empty($path)){
          $contents = Storage::url($path);
        }
        else {
          $contents="/storage/default/no-images.png";
        }
        //mengirimkan data di variable registers dengan nama "data" ke view registrasi-edit
      	return view('registrasi.registrasi-confirm', [
                'data' => $registers,
                'pict' => $contents
              ]);
        }

        public function delete(Request $request)
        {
          $id = $request->id;
          //$registers = Register::findOrFail($id); //mirip "select name from customer where id = 2"
          $images = Image::where('register_id', $id)->get();
          foreach ($images as $image) {
            Storage::delete($image->location);
          }

          $register = Register::find($id);
          $gambar=$register->gambar;
          if (!empty($gambar)){
              Storage::delete($gambar);
          }
          $register_number=$register->register_number;
          $register->delete();

          return redirect('/registrasi/remove')->with('status', 'Data registrasi dengan nomer BAST '.$register_number.' berhasil dihapus');
        }

      //menampilkan view add menu registrasi http://alamat_host/registrasi/add
        public function add()
        {
    	//menampilkan view registrasi-add.blade.php
            $cities = City::orderBy('province_id', 'asc')->get();
            return view('registrasi.registrasi-add',[
                    'cities' => $cities
                  ]);
        }

        public function adds()
        {
          return view('registrasi-adds');
        }


      //Fungsi untuk menambah data koleksi registrasi baru
        public function save(Request $request)
        {
    	//Register adalah nama model
              $register = new Register;
              $gambar=$request->picture;
              //Pengecekan apakah form picture diisi atau kosong
              if (!empty($gambar)){
                $this->validate($request, [
                      'picture' => 'image',
                ]);
                $path=$request->file('picture')->store('public/registrasi');
                $register->gambar = $path;
              }

              $register->nama = $request->nama;
              $register->tipe = $request->tipe_benda;
              $register->tgl_perolehan = $request->tgl_perolehan;

                        $tahun = substr($request->tgl_perolehan,0,4);
                        $tipe_benda = $request->tipe_benda;
                        if ($tipe_benda == "Benda Artefak")
                        {
                          $tipe = "A";
                        }
                        else {
                          $tipe = "B";
                        }

                        $jumlah = Register::whereYear('tgl_perolehan', '=', date('Y'))->count();
                        $urutan = $jumlah+1;
              $register->register_number = $tahun."-".$tipe."-".$urutan;

              $register->city_id = $request->asal_perolehan;
              $register->cara_perolehan = $request->perolehan;
              $register->tahun_pembuatan = $request->tahun_pembuatan;
              $register->panjang = $request->panjang;
              $register->lebar = $request->lebar;
              $register->tinggi = $request->tinggi;
              $register->berat = $request->berat;
              $register->sejarah = $request->sejarah;
              $register->harga_satuan = $request->harga_satuan;
              $register->keterangan = $request->keterangan;
              $register->bast = $request->bast;
              $register->nama_user = Auth::user()->nama_lengkap;
              $register->remember_token = $request->_token;
              //$register->created_at = $request->tanggal;
              $register->created_at = Carbon::now();
              //$register->updated_at = $request->tanggal;
              $register->updated_at = Carbon::now();
              $register->save();
              //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
      	       return redirect('/registrasi/add')->with('status', 'Data registrasi koleksi berhasil disimpan');

        }

      //Fungsi untuk menyimpan perubahan data koleksi registrasi
        public function store(Request $request)
        {
    	//Register adalah nama model
            $id = $request->id;
            $register = Register::find($id);
            $gambar=$request->picture;
            if (!empty($gambar)){
              $this->validate($request, [
                    'picture' => 'image',
              ]);
              $dataGambar = Register::findOrFail($id);
              $oldPict=$dataGambar->gambar;
              if ( $oldPict!=''){
                Storage::delete($oldPict);
              }
              $path=$request->file('picture')->store('public/registrasi');
              $register->gambar = $path;
            }
            $register->nama = $request->nama;

            $register->city_id = $request->asal_perolehan;
            $register->cara_perolehan = $request->perolehan;
            $register->panjang = $request->panjang;
            $register->lebar = $request->lebar;
            $register->tinggi = $request->tinggi;
            $register->berat = $request->berat;
            $register->sejarah = $request->sejarah;
            $register->harga_satuan = $request->harga_satuan;
            $register->tahun_pembuatan = $request->tahun_pembuatan;
            $register->keterangan = $request->keterangan;
            $register->bast = $request->bast;
            $register->remember_token = $request->_token;
            $register->updated_at = Carbon::now();
            $register->save();
            //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
    	      return redirect('/registrasi/'.$id.'/edit/')->with('status', 'Perubahan data registrasi koleksi telah disimpan');
        }
}
