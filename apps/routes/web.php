<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/



//database Customer
/*Route::get('/customer', function () {
    $customer = App\Customer::find(2);
    echo $customer->name;
});*/

Route::get('/sesi', function () {
    //return view('dashboard');
    //$data = $request->session()->all();
     $value = Auth::user();
     $name = Auth::user()->name;
     $level = Auth::user()->level;
     echo $value."<hr>";
     echo $name."<hr>";
     echo $level."<hr>";
})->middleware('auth');

Route::get('/customer/{id}', function ($id) {
    $customer = App\Customer::find($id);
    echo $customer->name;
});

Route::get('/customer_name', function () {
    $customer = App\Customer::where('name','=','bob')->first();
    echo $customer->id;
});

//upload file

//disable scaffold otentikasi
//Auth::routes();


//Login
//Lihat login route di php artisan route:list
      Route::get('/login', 'Auth\LoginController@showLoginForm');
      Route::post('/login', 'Auth\LoginController@login');
      Route::get('/logout', 'Auth\LoginController@logout');

      Route::get('/home', 'HomeController@index');
      Route::get('/', 'HomeController@index');
      //test upload file
      Route::post('/avatars', 'HomeController@upload');
      //test delete file
      Route::delete('/avatars', 'HomeController@delete');
      //test dashboard
      Route::get('/dashboard', 'HomeController@dashboard');

//User
      //menampilkan list data user
      Route::get('/user', 'UserController@index')->middleware('auth','administrator');
      //Route::get('/user', function () {
          //return view('dashboard');
      //});
      //menampilkan menu tambah data user
      Route::get('/user/add', 'UserController@add')->middleware('auth','administrator');
      //menampilkan detail data user
      Route::get('/user/{id}/detail', 'UserController@detail')->middleware('auth','administrator');
      //menyimpan data user yang ditambahkan ke database
      Route::post('/user/add', 'UserController@save');
      //konfirmasi untuk menghapus data user di database
      Route::get('/user/{id}/delete', 'UserController@confirm')->middleware('auth','administrator');
      //Melihat list data yang akan di hapus
      Route::get('/user/remove', 'UserController@remove')->middleware('auth','administrator');
      //menghapus data pengguna
      Route::delete('/user/delete/', 'UserController@delete');
      //menampilkan halaman edit data pengguna
      Route::get('/user/{id}/edit/', 'UserController@edit')->middleware('auth','administrator');
      //meyimpan perubahan data pengguna
      Route::put('/user/edit/', 'UserController@store');
      //menampilkan halaman edit password pengguna
      Route::get('/user/{id}/edit/password', 'UserController@editPassword')->middleware('auth','administrator');
      //menyimpan password user yang diubah ke database
      Route::put('/user/edit/password', 'UserController@storePassword');
      //Penggantian User Password
      Route::get('/password', 'UserController@password')->middleware('auth');
      //proses mengganti password baru
      Route::post('/password', 'UserController@changePassword');

//Propinsi
      //menampilkan list data propinsi dan form tambah data propinsi
      Route::get('/provinsi', 'AreaController@indexProvinsi')->middleware('auth');
      //Menambah data propinsi
      Route::post('/provinsi', 'AreaController@saveProvinsi')->middleware('auth','kurator');
      //Form Edit Data Propinsi
      Route::get('/provinsi/{id}/edit/', 'AreaController@editProvinsi')->middleware('auth','kurator');
      //meyimpan perubahan data provinsi
      Route::put('/provinsi/edit/', 'AreaController@storeProvinsi');
      //konfirmasi detail data propinsi sebelum di delete
      Route::get('/provinsi/{id}/delete/', 'AreaController@confirmProvinsi')->middleware('auth','kurator');
      //menghapus data registrasi
      Route::delete('/provinsi/delete/', 'AreaController@deleteProvinsi');

//Kota
      //menampilkan list data propinsi dan form tambah data propinsi
      Route::get('/kabupaten-kota', 'AreaController@indexCity')->middleware('auth');
      //Menambah data kota
      Route::post('/kabupaten-kota', 'AreaController@saveCity')->middleware('auth','kurator');
      //Test Relasi
      Route::get('/kabupaten-kota/relasi', 'AreaController@testrelasi');
      //Form Edit Data Kota
      Route::get('/kabupaten-kota/{id}/edit/', 'AreaController@editCity')->middleware('auth','kurator');
      //meyimpan perubahan data kota
      Route::put('/kabupaten-kota/edit/', 'AreaController@storeCity');
      //konfirmasi detail data kota sebelum di delete
      Route::get('/kabupaten-kota/{id}/delete/', 'AreaController@confirmCity')->middleware('auth','kurator');
      //menghapus data kota
      Route::delete('/kabupaten-kota/delete/', 'AreaController@deleteCity');


//Routing Registrasi Benda Koleksi
        //menampilkan halaman data registrasi
        Route::get('/registrasi', 'RegistrationController@index')->middleware('auth');
      	//menampilkan halaman registrasi dan data awal
      	Route::get('/registrasi/add', 'RegistrationController@add')->middleware('auth');
        //menampilkan halaman registrasi dan data awal (percobaan)
      	Route::get('/registrasi/adds', 'RegistrationController@adds')->middleware('auth');
      	//meyimpan data registrasi baru
        Route::post('/registrasi/add', 'RegistrationController@save');
        //menampilkan halaman edit data registrasi
        Route::get('/registrasi/{id}/edit/', 'RegistrationController@edit')->middleware('auth');
        //meyimpan perubahan data registrasi
        Route::put('/registrasi/edit/', 'RegistrationController@store');
        //melihat detail data registrasi
        Route::get('/registrasi/{id}/detail/', 'RegistrationController@detail')->middleware('auth');
        //Melihat list data yang akan di hapus
        Route::get('/registrasi/remove', 'RegistrationController@remove')->middleware('auth','kurator');
        //konfirmasi detail data registrasi sebelum di delete
        Route::get('/registrasi/{id}/delete/', 'RegistrationController@confirm')->middleware('auth','kurator');
        //menghapus data registrasi
        Route::delete('/registrasi/delete/', 'RegistrationController@delete');

//Routing Ruang Penyimpanan
        //menampilkan halaman data ruang
        Route::get('/ruang', 'StorageController@indexRuang')->middleware('auth');
        //Menambah data ruang
        Route::post('/ruang', 'StorageController@saveRuang')->middleware('auth','kurator');
        //Form Edit Data Ruang
        Route::get('/ruang/{id}/edit/', 'StorageController@editRuang')->middleware('auth','kurator');
        //meyimpan perubahan data ruang penyimpanan
        Route::put('/ruang/edit/', 'StorageController@storeRuang');
        //konfirmasi detail data ruang penyimpanan sebelum di delete
        Route::get('/ruang/{id}/delete/', 'StorageController@confirmRuang')->middleware('auth','kurator');
        //menghapus data ruang
        Route::delete('/ruang/delete/', 'StorageController@deleteRuang');

//Routing Rak Penyimpanan
        //menampilkan halaman data rak
        Route::get('/rak', 'StorageController@indexRak')->middleware('auth');
        //Menambah data rak
        Route::post('/rak', 'StorageController@saveRak')->middleware('auth','kurator');
        //Form Edit Data Rak
        Route::get('/rak/{id}/edit/', 'StorageController@editRak')->middleware('auth','kurator');
        //meyimpan perubahan data rak penyimpanan
        Route::put('/rak/edit/', 'StorageController@storeRak');
        //konfirmasi detail data rak penyimpanan sebelum di delete
        Route::get('/rak/{id}/delete/', 'StorageController@confirmRak')->middleware('auth','kurator');
        //menghapus data ruang
        Route::delete('/rak/delete/', 'StorageController@deleteRak');

//Routing klasifikasi jenis artefak
        //menampilkan halaman data jenis artefak
        Route::get('/jenis', 'ClassificationController@indexJenis')->middleware('auth');
        //Menambah data jenis artefak
        Route::post('/jenis', 'ClassificationController@saveJenis')->middleware('auth','kurator');
        //Form Edit Data jenis artefak
        Route::get('/jenis/{id}/edit/', 'ClassificationController@editJenis')->middleware('auth','kurator');
        //meyimpan perubahan data jenis artefak
        Route::put('/jenis/edit/', 'ClassificationController@storeJenis');
        //konfirmasi detail data jenis artefak sebelum di delete
        Route::get('/jenis/{id}/delete/', 'ClassificationController@confirmJenis')->middleware('auth','kurator');
        //menghapus data jenis artefak
        Route::delete('/jenis/delete/', 'ClassificationController@deleteJenis');

//Routing klasifikasi bentuk artefak
        //menampilkan klasifikasi bentuk artefak
        Route::get('/bentuk', 'ClassificationController@indexBentuk')->middleware('auth');
        //Menambah data bentuk artefak
        Route::post('/bentuk', 'ClassificationController@saveBentuk')->middleware('auth','kurator');
        //Form Edit Data Bentuk Artefak
        Route::get('/bentuk/{id}/edit/', 'ClassificationController@editBentuk')->middleware('auth','kurator');
        //meyimpan perubahan data rak penyimpanan
        Route::put('/bentuk/edit/', 'ClassificationController@storeBentuk');
        //konfirmasi detail data rak penyimpanan sebelum di delete
        Route::get('/bentuk/{id}/delete/', 'ClassificationController@confirmBentuk')->middleware('auth','kurator');
        //menghapus data ruang
        Route::delete('/bentuk/delete/', 'ClassificationController@deleteBentuk');

//Routing Inventarisir Benda Artefak
        //menampilkan halaman data artefak
        Route::get('/artefak', 'ArtifactController@index')->middleware('auth');
        //menampilkan halaman inventarisir artefak dan data awal
        Route::get('/artefak/add', 'ArtifactController@add')->middleware('auth');
        //menampilkan halaman input detail inventaris benda artefak
        Route::get('/artefak/add/{id}/detail', 'ArtifactController@addDetail')->middleware('auth','kurator');
        //meyimpan data detail inventaris artefak
        Route::post('/artefak/add', 'ArtifactController@save');
        //menampilkan halaman detail data inventaris artefak
        Route::get('/artefak/view/{id}/detail', 'ArtifactController@viewDetail')->middleware('auth');
        //menampilkan halaman edit data inventaris artefak
        Route::get('/artefak/edit/{id}/detail', 'ArtifactController@editDetail')->middleware('auth','kurator');
        //menyimpan perubahan data artefak
        Route::put('/artefak/edit', 'ArtifactController@store');
        //melihat list data artefak yang akan dihapus
        Route::get('/artefak/delete', 'ArtifactController@removeList')->middleware('auth');
        //konfirmasi data artefak yang akan dihapus
        Route::get('/artefak/delete/{id}/confirm', 'ArtifactController@removeConfirm')->middleware('auth','kurator');
        //menghapus data inventaris
        Route::delete('/artefak/delete/', 'ArtifactController@delete');
