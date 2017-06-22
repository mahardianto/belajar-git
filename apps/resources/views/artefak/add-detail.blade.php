@extends('layouts.dashboard')

@section('content')

<style>
img {
    max-width: 30%;
    height: auto;
}
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Sistem Informasi Database Koleksi
    <small>Monumen Pers Nasional</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    <li><i class="fa fa-database"></i> Inventaris</li>
    <li><i class="fa fa-bank"></i> Artefak</li>
    <li> Input Detail</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Input Inventaris Artefak</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      @if (count($errors) > 0)
      <div class="callout callout-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
    <div class="col-md-6">
      <div class="col-md-12">
      @foreach ($data as $koleksi)
          <?php $register_id = $koleksi->id; ?>
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:25%">Nomer Register</th>
                  <td>{{ $koleksi->register_number }}</td>
                </tr>
                <th style="width:25%">Nama Benda Koleksi</th>
                  <td>{{ $koleksi->nama }}</td>
                </tr>
                <th>Nomer Berita Acara Serah Terima</th>
                  <td>{{ $koleksi->bast }}</td>
                </tr>
                <tr>
                  <th>Tipe Benda</th>
                  <td>{{ $koleksi->tipe }}</td>
                </tr>
                <tr>
                  <th>Tanggal Register</th>
                  <td>{{ $koleksi->created_at }}</td>
                </tr>
                <tr>
                  <th>Tanggal perolehan</th>
                  <td>{{ $koleksi->tgl_perolehan }}</td>
                </tr>
                <tr>
                  <th>Asal Daerah Perolehan</th>
                  <td>{{ $koleksi->city->name }} , {{ $koleksi->city->province->name }}</td>
                </tr>
                <tr>
                  <th>Ukuran</th>
                  <td>{{ $koleksi->panjang }} x {{ $koleksi->lebar }} x {{ $koleksi->tinggi }} (cm)</td>
                </tr>
                <tr>
                  <th>Berat</th>
                  <td>{{ $koleksi->berat }} gram</td>
                </tr>
                <tr>
                  <th>Cara Perolehan</th>
                  <td>{{ $koleksi->cara_perolehan }}</td>
                </tr>
                <tr>
                  <th>Tahun Pembuatan</th>
                  <td>{{ $koleksi->tahun_pembuatan }}</td>
                </tr>
                <tr>
                  <th>Sejarah</th>
                  <td>{!! $koleksi->sejarah !!} </td>
                </tr>
                <tr>
                  <th>Harga satuan</th>
                  <td>{{ $koleksi->harga_satuan }}</td>
                </tr>
                <tr>
                  <th>Gambar</th>
                  <td><img src="{{ url($pict) }}"></td>
                </tr>
                <tr>
                  <th></th>
                  <td><a target="_blank" href="{{ url($pict) }}"><button type="button" class="btn btn-success">Download Gambar</button></a></td>
                </tr>
                <tr>
                  <th>Keterangan</th>
                  <td>{!! $koleksi->keterangan !!}</td>
                </tr>
                  <tr>
                    <th class="col-md-3">Nama Registrar</th>
                    <td>{{ $koleksi->nama_user }}</td>
                  </tr>
            </table>
          </div>
          @endforeach
        </div>
      </div>
      <div class="col-md-6">
        <div class="col-md-12">
          <form role="form" method="POST" action="{{ url('/artefak/add') }}" enctype="multipart/form-data">
            {!! csrf_field() !!}
                  @if (session('status'))
                      <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                          <h4><i class="icon fa fa-check"></i> Success!</h4>
                          {{ session('status') }}
                      </div>
                  @endif
              <div class="row">
                <!-- Tambahan -->
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">Bentuk dan Tipe Artefak</label>
                            <select class="form-control select2" name="form_id" style="width: 100%;" required>
                              <option></option>
                              @foreach ($forms as $form)
                              <option value="{{ $form->id }}">{{ $form->name }}, Tipe {{ $form->type->name }}</option>
                              @endforeach
                            </select>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">Lokasi Penyimpanan</label>
                            <select class="form-control select2" name="rack_id" style="width: 100%;" required>
                              <option></option>
                              @foreach ($racks as $rack)
                              <option value="{{ $rack->id }}">Rak {{ $rack->name }}, Ruang {{ $rack->room->nama }}</option>
                              @endforeach
                            </select>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="exampleInputPassword1">Material Penyusun</label>
                            <select class="form-control select2" multiple="multiple" name="materials[]" style="width: 100%;" required>
                              <option></option>
                              <option value="Batu">Batu</option>
                              <option value="Besi">Besi</option>
                              <option value="Gerabah">Gerabah</option>
                              <option value="Kaca">Kaca</option>
                              <option value="Kain">Kain</option>
                              <option value="Kayu">Kayu</option>
                              <option value="Kerang">Kerang</option>
                              <option value="Plastik">Plastik</option>
                              <option value="Semen">Semen</option>
                              <option value="Tembaga">Tembaga</option>
                              <option value="Tulang">Tulang</option>
                            </select>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="exampleInputPassword1">Upload Gambar</label>
                      <input type="file" name="pictures[]" accept=".png" multiple/>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="exampleInputPassword1">Asal Usul Artefak</label>
                      <textarea class="textarea" name="provinance" placeholder="Asal Usul Benda" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                <!-- Tambahan -->
              </div>
              <!-- /.row -->
            <div class="box-footer">
              <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"> </span> Simpan</button>
              <a href=""><button type="button" class="btn btn-default">Cancel</button></a>
            </div>
            <input type="hidden" name="register_id" value="{{ $register_id }}">
          </form>
        </div>
      </div>

    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
  </div>
</div>
  <!-- /.box -->
</section>
<!-- /.content -->
@endsection
