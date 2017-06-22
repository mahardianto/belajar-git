@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            <div class="panel-heading">
                 <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="/registrasi/">Data Registrasi</a></li>
                  <li class="active">Konfirmasi</li>
                </ol>
            </div>
                <div class="panel-body">
                        {!! csrf_field() !!}
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Success Message -->
                        @foreach ($data as $koleksi)
                        <div class="alert alert-warning alert-dismissible" role="alert">
                              <strong>Warning!</strong> Apakah anda yakin akan menghapus data ini?
                        </div>
                        <div class="panel panel-default">
                        <div class="panel-heading"><b>Nomer Berita Acara Serah Terima (BAST)</b></div>
                            <div class="panel-body">{{ $koleksi->bast }}</div>
                            <table class="table table-condensed">
                              <tbody>
                                <tr>
                                  <th class='col-md-3'>Nama Benda Koleksi</th>
                                  <td>{{ $koleksi->nama }}</td>
                                </tr>
                                <tr>
                                  <th>Tipe Benda</th>
                                  <td>{{ $koleksi->tipe }}</td>
                                </tr>
                                <tr>
                                  <th>Tanggal perolehan</th>
                                  <td>{{ $koleksi->tgl_perolehan }}</td>
                                </tr>
                                <tr>
                                  <th>Asal Daerah Perolehan</th>
                                  <td>{{ $koleksi->asal_perolehan }}</td>
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
                                  <th>Asal Daerah Perolehan</th>
                                  <td>{{ $koleksi->tgl_masuk }}</td>
                                </tr>
                                <tr>
                                  <th>Sejarah</th>
                                  <td>{{ $koleksi->sejarah }}</td>
                                </tr>
                                <tr>
                                  <th>Harga satuan</th>
                                  <td>{{ $koleksi->harga_satuan }}</td>
                                </tr>
                                <tr>
                                  <th>Jumlah</th>
                                  <td>{{ $koleksi->jumlah }}</td>
                                </tr>
                                <tr>
                                  <th>Keterangan</th>
                                  <td>{{ $koleksi->keterangan }}</td>
                                </tr>
                              </tbody>
                            </table>
                            <div class="modal-footer">
                              <form id="formID" class="form-horizontal" role="form" method="POST" action="{{ url('/registrasi/delete') }}">
                              {!! csrf_field() !!}
                              <a href="{{ url('registrasi') }}">
                              <button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button></a>
                              <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                              <input type="hidden" name="id" value="{{ $koleksi->id }}">
                              <input type="hidden" name="_method" value="DELETE">
                            </form>
                            </div>
                          </div>
                       @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
