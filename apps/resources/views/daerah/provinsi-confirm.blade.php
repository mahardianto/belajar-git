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
    <li><i class="fa fa-map"></i> Provinsi</li>
    <li>Confirm Delete</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <!-- box-header -->
    <div class="box-header with-border">
      <h3 class="box-title">Data Provinsi</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <!-- box-body -->
    <div class="box-body">
      <div class="alert alert-warning alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-warning"></i> Alert!</h4>
          Anda Yakin akan menghapus data ini?
      </div>

      <!-- Error or Success Notif -->
      <div class="col-md-6">
        <form role="form" method="POST" action="{{ url('/provinsi/delete') }}">
        {!! csrf_field() !!}
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="namaPropinsi">Hapus Data Propinsi</label>
            @foreach ($datum as $provinsi)
             <input type="text" class="form-control" placeholder="Nama Propinsi" name="name" value="{{ $provinsi->name }}" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" disabled>
             @if ($errors->has('name'))
                 <span class="help-block">
                     <strong>{{ $errors->first('name') }}</strong>
                 </span>
             @endif
         </div>
         <div class="form-group">
           <a href=""><button type="button" class="btn btn-default">Tidak</button></a>
            <button type="submit" class="btn btn-danger"> Ya, Hapus</button>
            <input type="hidden" name="id" value="{{ $provinsi->id }}">
            <input type="hidden" name="_method" value="DELETE">
          </div>
          @endforeach
        </form>
      </div>


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
