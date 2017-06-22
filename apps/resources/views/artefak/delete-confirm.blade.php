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
    <li> Remove Confirm</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Detail Inventaris Artefak</h3>
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
    @foreach ($data as $koleksi)
    <div class="col-md-6">
      <div class="col-md-12">
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
        </div>
      </div>
      <div class="col-md-6">
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            Anda Yakin akan menghapus data inventaris ini?
        </div>
        <div class="col-md-12">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:25%">Nomer Inventaris</th>
                <td>{{ $koleksi->artifact->inventory_number }}</td>
                </tr>
              <tr>
                <th style="width:25%">Tipe Artefak</th>
                <td>{{ $koleksi->artifact->form->type->name }}</td>
                </tr>
                <th style="width:25%">Bentuk Artefak</th>
                  <td>{{ $koleksi->artifact->form->name }}</td>
                </tr>
                <th>Ruang Penyimpanan</th>
                  <td>{{ $koleksi->artifact->rack->room->nama }}</td>
                </tr>
                <tr>
                  <th>Nomer Rak</th>
                  <td>{{ $koleksi->artifact->rack->name }}</td>
                </tr>
                <tr>
                  <th>Material Penyusun</th>
                  <td>
                    @foreach ($materials as $bahan)
                      {{ $bahan->name }},&nbsp;
                    @endforeach
                  </td>
                </tr>
                <tr>
                  <th>Asal Usul Benda</th>
                  <td>{!! $koleksi->artifact->provinance !!}</td>
                </tr>
            </table>
          </div>
          <b>Gambar Detail Artefak:</b><br/><br/>
            @foreach ($pictures as $picture)
              <a href="{{ $picture }}" target="_blank"><img src="{{ $picture }}"></a>&nbsp;
            @endforeach
        </div>
        <div class="form-group">
          <form role="form" method="POST" action="{{ url('/artefak/delete') }}">
          {!! csrf_field() !!}
          <a href="/artefak/delete"><button type="button" class="btn btn-default">Tidak</button></a>
           <button type="submit" class="btn btn-danger"> Ya, Hapus</button>
           <input type="hidden" name="id" value="{{ $koleksi->id }}">
           <input type="hidden" name="_method" value="DELETE">
         </form>
         </div>
      </div>
      @endforeach
    <!-- /.box-body -->

    <!-- /.box-footer-->
  </div>
  <div class="box-footer">

  </div>
</div>
  <!-- /.box -->
</section>
<!-- /.content -->
@endsection
