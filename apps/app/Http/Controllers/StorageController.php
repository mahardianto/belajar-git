<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//memasukkan skrip model Room untuk komunikasi dengan tabel database rooms
use App\Room;

//memasukkan skrip model Rack untuk komunikasi dengan tabel database racks
use App\Rack;

class StorageController extends Controller
{
    //List & Add View data ruang
    public function indexRuang()
    {
      $rooms = Room::orderBy('nama', 'asc')->get();
    	return view('penyimpanan.room-list', [
              'data' => $rooms
            ]);
    }

    //List & Add View data ruang
    public function saveRuang(Request $request)
    {
        $this->validate($request, [
           'nama'            => 'required|unique:rooms'     // required and must be unique in the ducks table
        ]);
        //Provinsi adalah nama model
        $ruang = new Room;
        $ruang->nama = $request->nama;
        $ruang->uraian = $request->uraian;
        $ruang->save();
        //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
         return redirect('/ruang')->with('status', 'Data Ruang berhasil disimpan');
    }

    public function editRuang($id)
    {
      $ruang = Room::where('id', $id)->get();
      $rooms = Room::orderBy('nama', 'asc')->get();
      return view('penyimpanan.room-edit', [
              'data' => $rooms,
              'datum' => $ruang
            ]);
    }

    public function storeRuang(Request $request)
      {
         $this->validate($request, [
            'nama'            => 'required|unique:rooms'     // required and must be unique in the ducks table
         ]);
          $id = $request->id;
          $ruang = Room::find($id);
          $ruang->nama = $request->nama;
          $ruang->uraian = $request->uraian;
          $ruang->save();
  	      return redirect('/ruang/'.$id.'/edit/')->with('status', 'Perubahan data ruang telah disimpan');
      }

      public function confirmRuang($id)
      {
          $data = Room::where('id', $id)->get();
          return view('penyimpanan.room-confirm', [
                  'datum' => $data
                ]);
      }

      public function deleteRuang(Request $request)
      {
          $id = $request->id;
          $ruang = Room::findOrFail($id);
          $name=$ruang->nama;
          $ruang->delete();
          return redirect('/ruang')->with('status', 'Data Ruang dengan nama '.$name.' berhasil dihapus');
      }


      //Rak Penyimpanan
      public function indexRak()
      {
        //$provinces = Province::orderBy('name', 'asc')->paginate(15);
        $racks = Rack::orderBy('room_id', 'asc')->get();
        $rooms = Room::orderBy('nama', 'asc')->get();
      	return view('penyimpanan.rack-list', [
                'racks' => $racks,
                'rooms' => $rooms
              ]);
      }

      public function saveRak(Request $request)
      {
          $this->validate($request, [
             'ruang'        => 'required',
             'name'         => 'required'
          ]);
          $rack = new Rack;
          $rack->room_id = $request->ruang;
          $rack->name = $request->name;
          $rack->save();
          //redirect ke halaman rak/ dengan status sukses yang dikirim lewat variable status
  	       return redirect('/rak')->with('status', 'Data Rak berhasil disimpan');
      }

      public function editRak($id)
      {
        $rack = Rack::findOrFail($id);
        $room_id=$rack->room_id;
        $rack_name=$rack->name;
        $racks = Rack::orderBy('name', 'asc')->get();
        $rooms = Room::orderBy('nama', 'asc')->get();
      	return view('penyimpanan.rack-edit', [
                'rooms' => $rooms,
                'room_id' => $room_id,
                'racks' => $racks,
                'rack_name'=> $rack_name,
                'id'=> $id
              ]);
      }

      public function storeRak(Request $request)
      {
          $this->validate($request, [
             'ruang'        => 'required',
             'name'         => 'required'     // required and must be unique in the cities table
          ]);
          $id=$request->id;
          $rack = Rack::find($id);
          $rack->room_id = $request->ruang;
          $rack->name = $request->name;
          $rack->save();
          //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
  	       return redirect('/rak/'.$id.'/edit')->with('status', 'Perubahan Data Rak Penyimpanan berhasil disimpan');
      }

      public function confirmRak($id)
      {
        $rack = Rack::findOrFail($id);
        $room_id = $rack->room_id;
        $rack_name = $rack->name;
        $rooms = Room::orderBy('nama', 'asc')->get();
        return view('penyimpanan.rack-confirm', [
                'rooms' => $rooms,
                'room_id' => $room_id,
                'rack_name'=> $rack_name,
                'id'=> $id
              ]);
      }

      public function deleteRak(Request $request)
      {
          $id = $request->id;
          $rack = Rack::findOrFail($id); //mirip "select name from customer where id = 2"
          $name=$rack->name;
          $rack->delete();
          return redirect('/rak')->with('status', 'Data Rak Penyimpanan dengan nama '.$name.' berhasil dihapus');
      }
}
