@extends('layouts.dashboard')
@section('content')
<section class="content-header">
  <h1>
    Sistem Informasi Database Koleksi
    <small>Monumen Pers Nasional</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    <li><i class="fa fa-book"></i> Registrasi</li>
    <li> Konfirmasi Hapus</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  @if (count($errors) > 0)
  <div class="callout callout-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Hapus Data Registrasi</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
      <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                Apakah anda yakin akan menghapus data ini?
              </div>
    <div>
      @foreach ($data as $koleksi)
          <div class="table-responsive">
            <table class="table">
              <tr>
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
                  <th>Ukuran</th>
                  <td>{{ $koleksi->panjang }} x {{ $koleksi->lebar }} x {{ $koleksi->tinggi }} (mm)</td>
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
                  <th>Asal Daerah Perolehan</th>
                  <td>{{ $koleksi->city->name }} , {{ $koleksi->city->province->name }}</td>
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
    <!-- /.box-body -->
    <form role="form" method="POST" action="{{ url('/registrasi/delete') }}">
      {!! csrf_field() !!}
    <div class="box-footer">
      <a href="/registrasi/remove "><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></a>
      <button type="submit" class="btn btn-danger">Ya, Hapus</button>
      <input type="hidden" name="id" value="{{ $koleksi->id }}">
      <input type="hidden" name="_method" value="DELETE">
    </div>
    </form>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->
</section>

@endsection
