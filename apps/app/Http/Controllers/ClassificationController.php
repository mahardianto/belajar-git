<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Type;
use App\Form;

class ClassificationController extends Controller
{
    /* Jenis Artefak Controller*/
    public function indexJenis()
    {
      $types = Type::orderBy('name', 'asc')->get();
    	return view('klasifikasi.jenis-list', [
              'data' => $types
            ]);
    }

    public function saveJenis(Request $request)
    {
        $this->validate($request, [
           'name'            => 'required|unique:types'     // required and must be unique in the ducks table
        ]);
        //Provinsi adalah nama model
        $jenis = new Type;
        $jenis->name = $request->name;
        $jenis->information = $request->information;
        $jenis->save();
        //redirect ke halaman registrasi/add dengan status sukses yang dikriim lewat variable status
         return redirect('/jenis')->with('status', 'Data Jenis Artefak berhasil disimpan');
    }

    public function editJenis($id)
    {
      $type = Type::where('id', $id)->get();
      $types = Type::orderBy('name', 'asc')->get();
      return view('klasifikasi.jenis-edit', [
              'data' => $types,
              'datum' => $type
            ]);
    }

    public function storeJenis(Request $request)
      {
         $oldname=$request->oldname;
         $newname=$request->name;

         if($oldname!=$newname){
           $this->validate($request, [
              'name'            => 'required|unique:types'     // required and must be unique in the ducks table
           ]);
          }
          $id = $request->id;
          $type = Type::find($id);
          $type->name = $request->name;
          $type->information = $request->information;
          $type->save();
          return redirect('/jenis/'.$id.'/edit/')->with('status', 'Perubahan data jenis artefak telah disimpan');
      }

      public function confirmJenis($id)
      {
          $data = Type::where('id', $id)->get();
          return view('klasifikasi.jenis-confirm', [
                  'datum' => $data
                ]);
      }

      public function deleteJenis(Request $request)
      {
          $id = $request->id;
          $type = Type::findOrFail($id);
          $name=$type->nama;
          $type->delete();
          return redirect('/jenis')->with('status', 'Data Jenis Artefak dengan nama '.$name.' berhasil dihapus');
      }

      /* Bentuk Artefak Controller*/

      public function indexBentuk()
      {
        $forms = Form::orderBy('type_id', 'asc')->get();
        $types = Type::orderBy('name', 'asc')->get();
      	return view('klasifikasi.bentuk-list', [
                'forms' => $forms,
                'types' => $types
              ]);
      }

      public function saveBentuk(Request $request)
      {
          $this->validate($request, [
             'type'        => 'required',
             'name'         => 'required'
          ]);
          $form = new Form;
          $form->type_id = $request->type;
          $form->name = $request->name;
          $form->save();
  	       return redirect('/bentuk')->with('status', 'Data Klasifikasi Bentuk berhasil disimpan');
      }

      public function editBentuk($id)
      {
        $form = Form::findOrFail($id);
        $type_id=$form->type_id;
        $form_name=$form->name;
        $forms = Form::orderBy('name', 'asc')->get();
        $types = Type::orderBy('name', 'asc')->get();
      	return view('klasifikasi.bentuk-edit', [
                'types' => $types,
                'type_id' => $type_id,
                'forms' => $forms,
                'form_name'=> $form_name,
                'id'=> $id
              ]);
      }

      public function storeBentuk(Request $request)
      {
          $this->validate($request, [
             'type'        => 'required',
             'name'         => 'required'
          ]);
          $id=$request->id;
          $form = Form::find($id);
          $form->type_id = $request->type;
          $form->name = $request->name;
          $form->save();
  	       return redirect('/bentuk/'.$id.'/edit')->with('status', 'Perubahan Klasifikasi Bentuk Artefak berhasil disimpan');
      }

      public function confirmBentuk($id)
      {
        $form = Form::findOrFail($id);
        $type_id = $form->type_id;
        $form_name = $form->name;
        $types = Type::orderBy('name', 'asc')->get();
        return view('klasifikasi.bentuk-confirm', [
                'types' => $types,
                'type_id' => $type_id,
                'form_name'=> $form_name,
                'id'=> $id
              ]);
      }

      public function deleteBentuk(Request $request)
      {
          $id = $request->id;
          $form = Form::findOrFail($id); //mirip "select name from customer where id = 2"
          $name=$form->name;
          $form->delete();
          return redirect('/bentuk')->with('status', 'Data Klasifikasi Bentuk Artefak dengan nama '.$name.' berhasil dihapus');
      }
}
