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
    <li><i class="fa fa-database"></i> Inventaris</li>
    <li><i class="fa fa-bank"></i>Artefak</li>
    <li>Tambah</li>
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
      <h3 class="box-title">Tambah Data Inventaris Benda Artefak</h3>
      <div class="box-tools pull-right">
        <!--<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>-->
      </div>
    </div>

      <div class="box-body table-responsive">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-hover table-condensed table-bordered">
          <tr>
            <th><div align="center">Nomer Register</div></th>
            <th>Nama</th>
            <th>Tipe</th>
            <th>Tgl Perolehan</th>
            <th>Asal Perolehan</th>
            <th>Nomer Berita Acara Serah Terima</th>
            <th>Opsi</th>
          </tr>

             @foreach ($data as $koleksi)
                <tr>
                    <!-- Task Name -->
                    <td class="table-text">
                        <div align="center">{{ $koleksi->register_number }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $koleksi->nama }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $koleksi->tipe }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $koleksi->tgl_perolehan }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $koleksi->city->name }} , {{ $koleksi->city->province->name }}</div>
                    </td>
                    <td class="table-text">
                        <div>{{ $koleksi->bast }}</div>
                    </td>
                    <td>
                      <div class="btn-group" role="group" aria-label="...">
                        <a target="_blank" href="{{ url('registrasi/'.$koleksi->id.'/detail') }}"><button type="button" class="btn btn-info"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"> </span> Detail</button></a>
                        <a href="{{ url('artefak/add/'.$koleksi->id.'/detail') }}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"> </span> Inventaris</button></a>
                      </div>
                    </td>
                </tr>

            @endforeach
        </table>
      </div>

    <!-- /.box-body -->
    <div class="box-footer">
      &nbsp;
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->
</section>
<!-- /.content -->

@endsection
