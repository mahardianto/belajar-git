<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Nambahin fungsi Carbon untuk waktu
use Carbon\Carbon;
//memasukkan skrip model User untuk komunikasi dengan tabel database user
use App\User;
//memasukkan skrip model Profile untuk komunikasi dengan tabel database profiles
use App\Profile;
//nambahin Hash untuk enkripsi password
use Hash;
//ngambil session
use Auth;

class UserController extends Controller
{
    //

        //
        //menampilkan view list menu pengguna http://alamat_host/user/
        public function index()
        {
        	//memasukkan hasil query dari model bernama "User" ke variable pengguna
        	//$pengguna = User::orderBy('created_at', 'asc')->paginate(15);
          $pengguna = User::where('id', '!=','1')->paginate(15);
          //mengirimkan data di variable pengguna dengan nama "pengguna" ke view user-list
        	return view('pengguna.user-list', [
                  'pengguna' => $pengguna
                ]);
        }

        public function remove()
        {
        	//memasukkan hasil query dari model bernama "User" ke variable pengguna
        	//$pengguna = User::orderBy('created_at', 'asc')->paginate(15);
          $pengguna = User::where('id', '!=','1')->paginate(15);
          //mengirimkan data di variable pengguna dengan nama "pengguna" ke view user-list
        	return view('pengguna.user-remove', [
                  'pengguna' => $pengguna
                ]);
        }

        //menampilkan menu tambah data pengguna
        public function add()
        {
    	  //menampilkan view user-add.blade.php
            return view('pengguna.user-add');
        }

        //menyimpan data pengguna yang ditambahkan ke database
        public function save(Request $request)
        {
          $this->validate($request, [
             'email'            => 'required|email|unique:users',     // required and must be unique in the ducks table
             'password'         => 'required',
             'password_confirmation' => 'required|same:password'
          ]);
    	     //User adalah nama model
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->nama_lengkap = $request->nama_lengkap;
            $user->nip = $request->nip;
            $user->level = $request->level;
            $user->password = Hash::make($request->password);
            $user->remember_token = $request->_token;
            $user->created_at = Carbon::now();
            $user->updated_at = Carbon::now();
            $user->save();
            //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
    	      return redirect('/user/add')->with('status', 'Data user berhasil disimpan');
        }

        //menampilkan tampilan menu edit pengguna
        public function edit($id)
        {
        	//memasukkan hasil query dari model bernama "User" ke variable user
        	$user = User::where('id', $id)->where('id','!=','1')->get();
          //mengirimkan data didalam variable user dengan nama "data" ke view user-edit
        	return view('pengguna.user-edit', [
                  'data' => $user
                ]);
        }

        //Fungsi untuk menyimpan perubahan data pengguna
        public function store(Request $request)
          {
      	     //User adalah nama model
              $id = $request->id;
              $user = User::find($id);
              $user->level = $request->level;
              $user->name = $request->name;
              $user->nama_lengkap = $request->nama_lengkap;
              $user->nip = $request->nip;
              $user->remember_token = $request->_token;
              $user->updated_at = Carbon::now();
              //$user->nama = $request->nama;
              $user->save();
              //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
      	      return redirect('/user/'.$id.'/edit/')->with('status', 'Perubahan data pengguna telah disimpan');
          }

        public function editPassword($id)
        {
        	//memasukkan hasil query dari model bernama "User" ke variable user
        	$user = User::where('id', $id)->get();
          //mengirimkan data didalam variable user dengan nama "data" ke view user-edit
          return view('pengguna.user-password-edit', [
                  'data' => $user
                ]);
        }

        //Fungsi untuk menyimpan perubahan password pengguna
        public function storePassword(Request $request)
        {
            //User adalah nama model
            $this->validate($request, [
               'password'         => 'required',
               'password_confirmation' => 'required|same:password'
            ]);

            $id = $request->id;
            $password = $request->password;
            $password_confirmation = $request->password_confirmation;
            /*$currentPassword = $request->password_lama;
            $data = User::where('id', $id)->get();
            foreach ($data as $datum) {
                $databasePassword=$datum->password;
            }*/
            //cek password lama dengan password di database
            if ($password==$password_confirmation) {
              $user = User::findOrFail($id);
              $user->fill(['password' => Hash::make($request->password)])->save();
              return redirect('/user/'.$id.'/edit/password')->with('status', 'Password berhasil dirubah');
            }
            else {
              return redirect('/user/'.$id.'/edit/password')->with('error', 'Password Baru harus sama dengan Konfirmasi Password Baru');
            }
        }

        //menampilkan konfirmasi data pengguna sebelum di hapus
        public function confirm($id)
        {
            //return view('user-add');
            $user = User::where('id', $id)->where('id','!=','1')->get();
            //mengirimkan data di variable user dengan nama "data" ke view user-detail
          	return view('pengguna.user-confirm', [
                    'data' => $user
                  ]);
        }

        //menghapus data pengguna
        public function delete(Request $request)
        {
          $id = $request->id;
          if ($id!=1){
            $user = User::findOrFail($id); //mirip "select name from customer where id = 2"
            $nama_lengkap=$user->nama_lengkap;
            $user->delete();
            return redirect('/user/remove')->with('status', 'Data Pengguna dengan nama '.$nama_lengkap.' berhasil dihapus');
          }
          else {
            return redirect('/user/remove')->with('error', 'Data User Administrator tidak bisa dihapus');
          }

        }

        //Password user yang aktif
        public function password()
        {
            return view('pengguna.user-password');
        }

        public function changePassword(Request $request)
        {
          $this->validate($request, [
             'password'         => 'required',
             'password_confirmation' => 'required|same:password'
          ]);

          $hashedPassword=Auth::user()->password;
          $idUser=Auth::user()->id;

          $currentPassword = $request->currentPassword;
          $password = $request->password;
          $newPassword=Hash::make($request->password);

          if (Hash::check($currentPassword, $hashedPassword)) {
            $user = User::findOrFail($idUser);
            $user->fill(['password' => Hash::make($request->password)])->save();
            return redirect('/password')->with('status', 'Password berhasil dirubah');
          }
          else {
            return redirect('/password')->with('error', 'Password lama yang anda masukkan tidak cocok dengan data di database');
          }
        }
}
