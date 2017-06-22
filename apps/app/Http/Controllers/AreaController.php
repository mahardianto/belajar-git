<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Nambahin fungsi Carbon untuk waktu
use Carbon\Carbon;
//memasukkan skrip model Provinsi untuk komunikasi dengan tabel database provinces
use App\Province;
//memasukkan skrip model City untuk komunikasi dengan tabel database cities
use App\City;

class AreaController extends Controller
{
    //

        /* Start Propinsi */
        //List Propinsi dan form add Propinsi
        public function indexProvinsi()
        {
          //$provinces = Province::orderBy('name', 'asc')->paginate(15);
          $provinces = Province::orderBy('name', 'asc')->get();
        	return view('daerah.provinsi-list', [
                  'data' => $provinces
                ]);
        }

        public function saveProvinsi(Request $request)
        {
            $this->validate($request, [
               'name'            => 'required|unique:provinces'     // required and must be unique in the ducks table
            ]);
            //Provinsi adalah nama model
            $propinsi = new Province;
            $propinsi->name = $request->name;
            //$register->created_at = $request->tanggal;
            $propinsi->created_at = Carbon::now();
            //$register->updated_at = $request->tanggal;
            $propinsi->updated_at = Carbon::now();
            $propinsi->save();
            //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
    	       return redirect('/provinsi')->with('status', 'Data Provinsi berhasil disimpan');
        }

        public function editProvinsi($id)
        {
          $province = Province::where('id', $id)->get();
          $provinces = Province::orderBy('name', 'asc')->get();
        	return view('daerah.provinsi-edit', [
                  'data' => $provinces,
                  'datum' => $province
                ]);
        }

        public function storeProvinsi(Request $request)
          {
      	     //User adalah nama model
             $this->validate($request, [
                'name'            => 'required|unique:provinces'     // required and must be unique in the ducks table
             ]);
              $id = $request->id;
              $province = Province::find($id);
              $province->name = $request->name;
              $province->updated_at = Carbon::now();
              //$user->nama = $request->nama;
              $province->save();
              //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
      	      return redirect('/provinsi/'.$id.'/edit/')->with('status', 'Perubahan data provinsi telah disimpan');
          }

          public function confirmProvinsi($id)
          {
              $data = Province::where('id', $id)->get();
            	return view('daerah.provinsi-confirm', [
                      'datum' => $data
                    ]);
          }

          public function deleteProvinsi(Request $request)
          {
              $id = $request->id;
              $province = Province::findOrFail($id); //mirip "select name from customer where id = 2"
              $name=$province->name;
              $province->delete();
              return redirect('/provinsi')->with('status', 'Data Provinsi dengan nama '.$name.' berhasil dihapus');
          }
    /* End Propinsi */
    /*Start Kabupaten */
          public function indexCity()
          {
            //$provinces = Province::orderBy('name', 'asc')->paginate(15);
            $cities = City::orderBy('province_id', 'asc')->get();
            $provinces = Province::orderBy('name', 'asc')->get();
          	return view('daerah.kota-list', [
                    'cities' => $cities,
                    'provinces' => $provinces
                  ]);
          }

          public function saveCity(Request $request)
          {
              $this->validate($request, [
                 'propinsi'        => 'required',
                 'name'            => 'required'     // required and must be unique in the ducks table
              ]);
              //Provinsi adalah nama model
              $kota = new City;
              $kota->province_id = $request->propinsi;
              $kota->name = $request->name;
              //$register->created_at = $request->tanggal;
              $kota->created_at = Carbon::now();
              //$register->updated_at = $request->tanggal;
              $kota->updated_at = Carbon::now();
              $kota->save();
              //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
      	       return redirect('/kabupaten-kota')->with('status', 'Data Kabupaten/Kota berhasil disimpan');
          }

          public function editCity($id)
          {
            //echo "Edit Kota";
            $city = City::findOrFail($id); //mirip "select name from customer where id = 2"
            $province_id=$city->province_id;
            $city_name=$city->name;
            $cities = City::orderBy('name', 'asc')->get();
            $provinces = Province::orderBy('name', 'asc')->get();
          	return view('daerah.kota-edit', [
                    'provinces' => $provinces,
                    'province_id' => $province_id,
                    'cities' => $cities,
                    'city_name'=> $city_name,
                    'id'=> $id
                  ]);
          }

          public function storeCity(Request $request)
          {
              $this->validate($request, [
                 'propinsi'        => 'required',
                 'name'            => 'required|unique:cities'     // required and must be unique in the cities table
              ]);
              //Provinsi adalah nama model
              $id=$request->id;
              //$city = City::findOrFail($id);
              //$city_id= $city->id;
              $kota = City::find($id);
              //$kota = new City;
              $kota->province_id = $request->propinsi;
              $kota->name = $request->name;
              //$register->created_at = $request->tanggal;
              $kota->created_at = Carbon::now();
              //$register->updated_at = $request->tanggal;
              $kota->updated_at = Carbon::now();
              $kota->save();
              //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
      	       return redirect('/kabupaten-kota/'.$id.'/edit')->with('status', 'Perubahan Data Kabupaten/Kota berhasil disimpan');
          }

          public function confirmCity($id)
          {
            //echo "Edit Kota";
            $city = City::findOrFail($id); //mirip "select name from customer where id = 2"
            $province_id=$city->province_id;
            $city_name=$city->name;
            $provinces = Province::orderBy('name', 'asc')->get();
            return view('daerah.kota-confirm', [
                    'provinces' => $provinces,
                    'province_id' => $province_id,
                    'city_name'=> $city_name,
                    'id'=> $id
                  ]);
          }

          public function deleteCity(Request $request)
          {
              $id = $request->id;
              $city = City::findOrFail($id); //mirip "select name from customer where id = 2"
              $name=$city->name;
              $city->delete();
              return redirect('/kabupaten-kota')->with('status', 'Data Kota dengan nama '.$name.' berhasil dihapus');
          }
    /* End Kabupaten */
}
