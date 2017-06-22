@extends('layouts.dashboard')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Sistem Informasi Database Koleksi
    <small>Monumen Pers Nasional</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    <li><i class="fa fa-book"></i> Registrasi</li>
    <li> Tambah Data</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Error or Success Notif -->
  @if (count($errors) > 0)
  <div class="callout callout-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <!-- Error or Success Notif -->
  <!-- Default box -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Data Registrasi</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- <form role="form"> -->
    <form role="form" method="POST" action="{{ url('/registrasi/add') }}" enctype="multipart/form-data">
      {!! csrf_field() !!}
      <div class="box-body">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Success!</h4>
                    {{ session('status') }}
                </div>
            @endif
        <div class="row">
          <!-- Tambahan -->
              <div class="form-group col-md-4">
                <label for="namaBendaKoleksi">Nama Benda Koleksi</label>
                 <input type="text" class="form-control" id="namaBendaKoleksi" placeholder="Nama Benda" name="nama" value="" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputPassword1">Tipe Benda</label>
                      <select class="form-control select2" name="tipe_benda" style="width: 100%;" required>
                        <option></option>
                        <option value="Benda Artefak">Benda Artefak</option>
                        <option value="Media Cetak">Media Cetak</option>
                      </select>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputPassword1">Tanggal Perolehan</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control" id="datepicker" name="tgl_perolehan" data-inputmask="'alias': 'yyyy-mm-dd'" data-mask required>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group col-md-3">
                <!-- <label for="exampleInputPassword1">Asal Daerah Perolehan</label>
                <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nama Daerah" name="asal_perolehan" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" value="" required> -->
                <label for="exampleInputPassword1">Asal Daerah Perolehan</label>
                      <select class="form-control select2" name="asal_perolehan" style="width: 100%;" required>
                        <option></option>
                        @foreach ($cities as $city)
                        <option value="{{ $city->id }}">Kota {{ $city->name }}, {{ $city->province->name }}</option>
                        @endforeach
                      </select>
              </div>
              <div class="form-group col-md-4">
                <label for="exampleInputPassword1">Ukuran Panjang x Lebar x Tinggi</label>
                <div class="input-group">
                      <input type="number" class="form-control" name="panjang" min="0" placeholder="Panjang" required>
                      <span class="input-group-addon">cm</span>
                      <input type="number" class="form-control" name="lebar" min="0" placeholder="Lebar" required>
                      <span class="input-group-addon">cm</span>
                      <input type="number" class="form-control" name="tinggi" min="0" placeholder="Tinggi" required>
                      <span class="input-group-addon">cm</span>
                    </div>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputPassword1">Berat</label>
                <div class="input-group">
                      <input type="number" class="form-control" placeholder="Berat" name="berat" min="0" value="" required>
                      <span class="input-group-addon">gram</span>
                    </div>
              </div>
              <div class="form-group col-md-2">
                <label for="exampleInputPassword1">Cara Perolehan</label>
                      <select class="form-control select2" name="perolehan" style="width: 100%;" required>
                        <option></option>
                        <option value="Berlangganan">Berlangganan</option>
                        <option value="Download">Download</option>
                        <option value="Hibah">Hibah</option>
                        <option value="Peminjaman">Peminjaman</option>
                        <option value="Pembelian">Pembelian</option>
                        <option value="Penggalian" >Penggalian</option>
                      </select>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputPassword1">Harga Satuan</label>
                <div class="input-group">
                       <span class="input-group-addon">Rp</span>
                       <input type="number" class="form-control" placeholder="Nilai rupiah" name="harga_satuan" value="" min="0" required>
                </div>
              </div>

              <div class="form-group col-md-3">
                <label for="exampleInputPassword1">Upload Gambar</label>
                <input type="file" name="picture" accept=".png"/>
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputPassword1">Tahun Pembuatan</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="number" class="form-control" name="tahun_pembuatan" data-inputmask="'alias': 'yyyy'" data-mask required>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group col-md-3">
                <label for="exampleInputPassword1">No Berita Acara Serah Terima</label>
                <input type="text" class="form-control col-md-4" id="exampleInputPassword1" placeholder="Nomer Surat Berita Acara Serah Terima" name="bast" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" value="" required>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Sejarah</label>
                <textarea class="textarea" name="sejarah" placeholder="Sejarah Benda" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
              <div class="form-group col-md-6">
                <label for="exampleInputPassword1">Keterangan</label>
                <textarea class="textarea" name="keterangan" placeholder="Keterangan Benda" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
              </div>
          <!-- Tambahan -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"> </span> Simpan</button>
        <a href=""><button type="button" class="btn btn-default">Cancel</button></a>
      </div>
    </form>
  <!--   </form> -->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->
@endsection
