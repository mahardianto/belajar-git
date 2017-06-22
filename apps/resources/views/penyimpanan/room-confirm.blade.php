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
    <li><i class="fa fa-archive"></i> Penyimpanan</li>
    <li>Remove</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <!-- box-header -->
    <div class="box-header with-border">
      <h3 class="box-title">Hapus Data Ruang Penyimpanan</h3>
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
          Anda yakin akan menghapus data ini?
      </div>
      @if (session('status'))
          <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> Success!</h4>
              {{ session('status') }}
          </div>
      @endif
      <!-- Error or Success Notif -->
      @if (count($errors) > 0)
      <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-ban"></i> Alert!</h4>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif
      <!-- Error or Success Notif -->
      <div class="col-md-4">
        <form role="form" method="POST" action="{{ url('/ruang/delete') }}">
        {!! csrf_field() !!}
        @foreach ($datum as $ruang)
        <div class="col-md-12">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="namaPropinsi">Nama Ruang</label>
             <input type="text" class="form-control" placeholder="Nama Ruang" name="nama" value="{{ $ruang->nama }}" disabled>
             @if ($errors->has('name'))
                 <span class="help-block">
                     <strong>{{ $errors->first('nama') }}</strong>
                 </span>
             @endif
         </div>
       </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputPassword1">Keterangan Ruang</label>
              <textarea class="textarea" name="uraian" placeholder="Keterangan Ruang" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" disabled>{{ $ruang->uraian }}</textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <a href="{{ url('/ruang') }}"><button type="button" class="btn btn-default">Tidak</button></a>
               <button type="submit" class="btn btn-danger"> Ya, Hapus</button>
             </div>
          </div>
          <input type="hidden" name="id" value="{{ $ruang->id }}">
          {{ method_field('DELETE') }}
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
