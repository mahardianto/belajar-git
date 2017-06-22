<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Storage;
use File;

use App\Register;
use App\City;
use App\Room;
use App\Rack;
use App\Type;
use App\Form;
use App\Artifact;
use App\Image;
use App\Material;


class ArtifactController extends Controller
{
    //

        //
        public function index()
        {
        $registers = Register::where('tipe', 'Benda Artefak')
                      ->where('inventory', 1)
                      ->paginate(15);
        return view('artefak.artefak-list', [
                'data' => $registers
              ]);
        }

        public function add()
        {
        $registers = Register::where('tipe', 'Benda Artefak')
                      ->where('inventory', 0)
                      ->paginate(15);
        return view('artefak.registrasi-list', [
                'data' => $registers
              ]);
        }

        public function addDetail($id)
        {
        $cities = City::orderBy('province_id', 'asc')->get();
        $racks = Rack::orderBy('room_id', 'asc')->get();
        $forms = Form::orderBy('type_id', 'asc')->get();
        $registers = Register::where('id', $id)->where('inventory', 0)->get();
        $dataGambar = Register::findOrFail($id);
        $path=$dataGambar->gambar;
        if (!empty($path)){
          $contents = Storage::url($path);
        }
        else {
          $contents="/storage/default/no-images.png";
        }
      	return view('artefak.add-detail', [
                'data' => $registers,
                'pict' => $contents,
                'cities' => $cities,
                'racks' => $racks,
                'forms' => $forms
              ]);
        }

        public function save(Request $request)
        {
              $this->validate($request, [
                 'materials'        => 'required',
                 'pictures'        => 'required'
              ]);
              $form_id = $request->form_id;
              $form = Form::findOrFail($form_id);
              $type_id = $form->type_id;
              $count = Artifact::where('form_id', $form_id)->count();
              $number_id = ++$count;

              $artefak = new Artifact;
              $artefak->form_id = $request->form_id;
              $artefak->rack_id = $request->rack_id;
              $artefak->provinance = $request->provinance;
              $artefak->inventory_number = "A.".$type_id.".".$form_id.".".$number_id;
              $register_id = $request->register_id;
              $artefak->register_id = $register_id;
              $artefak->save();

              //menyimpan di tabel images
              //$jumlahGambar=count($request->pictures);
              if (!empty($request->pictures)){
                   foreach ($request->pictures as $picture) {
                        $filename = $picture->store('public/artefak');
                        $image = new Image;
                        $image->location = $filename;
                        $image->register_id = $register_id;
                        $image->save();
                    }
                  }

              //menyimpan di tabel materials
              //$jumlahMaterial=count($request->materials);
              if (!empty($request->materials)){
                foreach($request->materials as $bahan) {
                  $material = new Material;
                  $material->name = $bahan;
                  $material->register_id = $register_id;
                  $material->save();
                }
              }

              //update di tabel registers
              $register = Register::find($register_id);
              $register->inventory = 1;
              $register->save();

               return redirect('/artefak/add')->with('status', 'Data Inventaris berhasil disimpan');
        }

        public function viewDetail($id)
        {
        $registers = Register::where('id', $id)->where('inventory', 1)->get();
        $dataGambar = Register::findOrFail($id);
        $materials = Material::where('register_id', $id)->get();
        $count = Image::where('register_id', $id)->count();
        if ($count > 0)
        {
          $images = Image::where('register_id', $id)->get();
            foreach ($images as $image) {
              $pictures[]=Storage::url($image->location);
            }
        }
        else {
          $pictures[]="/storage/default/no-images.png";
        }

        $path=$dataGambar->gambar;
        if (!empty($path)){
          $contents = Storage::url($path);
        }
        else {
          $contents="/storage/default/no-images.png";
        }
      	return view('artefak.view-detail', [
                'data' => $registers,
                'pict' => $contents,
                'materials'=> $materials,
                'pictures'=> $pictures
              ]);
        }

        public function editDetail($id)
        {
        $cities = City::orderBy('province_id', 'asc')->get();
        $racks = Rack::orderBy('room_id', 'asc')->get();
        $forms = Form::orderBy('type_id', 'asc')->get();
      	$registers = Register::where('id', $id)->where('inventory', 1)->get();
        $dataGambar = Register::findOrFail($id);
        $count = Image::where('register_id', $id)->count();

        $bahan = array("Batu", "Besi", "Gerabah", "Kaca", "Kain", "Kayu", "Kerang","Plastik", "Semen", "Tembaga", "Tulang");
        $composition = Material::where('register_id', $id)->get();
        foreach ($composition as $composite) {
          $compositions[]=$composite->name;
        }
        //gambar di data registrasi
        $path=$dataGambar->gambar;
        if (!empty($path)){
          $contents = Storage::url($path);
        }
        else {
          $contents="/storage/default/no-images.png";
        }

        if ($count > 0) {
          //mengambil data id images
          $images = Image::where('register_id', $id)->get();
            foreach ($images as $image) {
              $pictures[]=$image->id;
            }

          //mengambil data location
            foreach ($pictures as $picture) {
                $data = Image::findOrFail($picture);
                $dataPictures[$picture]=Storage::url($data->location);
            }
        }
        else {
          $pictures = 0;
          $dataPictures = "/storage/default/no-images.png";
        }


          return view('artefak.edit-detail', [
                'data' => $registers,
                'pict' => $contents,
                'cities' => $cities,
                'racks' => $racks,
                'forms' => $forms,
                'bahan' => $bahan,
                'compositions' => $compositions,
                'pictures'=> $pictures,
                'dataPictures'=> $dataPictures
              ]);
        }

        public function store(Request $request)
        {
          $this->validate($request, [
             'materials'        => 'required'
          ]);
          $register_id = $request->register_id;
          $id = $request->artifact_id;
          $form = Form::find($request->form_id);
          $newType = $form->type_id;
          $newForm = $request->form_id;

          $artefak = Artifact::find($id);
          $oldFormId = $artefak->form_id;
          $oldTypeId = $artefak->form->type_id;

          /*Cek Inventory Number */
          if ($oldTypeId!=$newType) {
            	$count = Artifact::where('form_id', $newForm)->count();
            	$number_id = ++$count;
            	$artefak->form_id = $newForm;
            	$artefak->inventory_number = "A.".$newType.".".$newForm.".".$number_id;
    	     }
          else {
              	if ($oldFormId!=$request->form_id) {
              	    $count = Artifact::where('form_id', $newForm)->count();
              	    $number_id = ++$count;
              	    $artefak->form_id = $newForm;
                    $artefak->inventory_number = "A.".$oldTypeId.".".$newForm.".".$number_id;
              	   }
              	}
            /*Cek Inventory Number */
            $artefak->rack_id = $request->rack_id;
            $artefak->provinance = $request->provinance;
            $artefak->save();

          if (!empty($request->deletePictures)){
            foreach ($request->deletePictures as $idPicture) {
                 $image = Image::find($idPicture);
                 Storage::delete($image->location);
                 $image->delete();
             }
          }

          if (!empty($request->pictures)){
               foreach ($request->pictures as $picture) {
                    $filename = $picture->store('public/artefak');
                    $image = new Image;
                    $image->location = $filename;
                    $image->register_id = $register_id;
                    $image->save();
                }
              }

            if (!empty($request->materials)){
              Material::where('register_id', $register_id)->delete();
              foreach($request->materials as $bahan) {
                $material = new Material;
                $material->name = $bahan;
                $material->register_id = $register_id;
                $material->save();
              }
            }

           return redirect('/artefak/edit/'.$register_id.'/detail')->with('status', 'Perubahan Data Inventaris Benda berhasil disimpan');
        }

        public function removeList()
        {
        $registers = Register::where('tipe', 'Benda Artefak')
                      ->where('inventory', 1)
                      ->paginate(15);
        return view('artefak.artefak-deleteList', [
                'data' => $registers
              ]);
        }

        public function removeConfirm($id)
        {
        //Perlu dikasih filter agar tidak terjadi pengulangan input data inventaris (cek inventory number harusnya 0)
      	$registers = Register::where('id', $id)->where('inventory', 1)->get();
        $dataGambar = Register::findOrFail($id);
        $materials = Material::where('register_id', $id)->get();
        $count = Image::where('register_id', $id)->count();
        if ($count > 0)
        {
          $images = Image::where('register_id', $id)->get();
            foreach ($images as $image) {
              $pictures[]=Storage::url($image->location);
            }
        }
        else {
          $pictures[]="/storage/default/no-images.png";
        }

        $path=$dataGambar->gambar;
        if (!empty($path)){
          $contents = Storage::url($path);
        }
        else {
          $contents="/storage/default/no-images.png";
        }
      	return view('artefak.delete-confirm', [
                'data' => $registers,
                'pict' => $contents,
                'materials'=> $materials,
                'pictures'=> $pictures
              ]);
        }

        public function delete(Request $request)
        {
            $id = $request->id;
            $dataRegister = Register::findOrFail($id);
            $idArtifact = $dataRegister->artifact->id;
            $dataRegister->inventory = 0;
            $dataRegister->save();

            Material::where('register_id', $id)->delete();
            $count = Image::where('register_id', $id)->count();
            if ($count > 0) {
              $images = Image::where('register_id', $id)->get();
              foreach ($images as $image) {
                Storage::delete($image->location);
              }

              Image::where('register_id', $id)->delete();
            }
            $artifact = Artifact::findOrFail($idArtifact);
            $inventory_number = $artifact->inventory_number;
            $artifact->delete();
            return redirect('/artefak')->with('status', 'Data Inventaris dengan nomer '.$inventory_number.' berhasil dihapus');
        }

}
