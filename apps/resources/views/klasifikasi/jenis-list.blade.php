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
    <li><i class="fa fa-archive"></i> Klasifikasi</li>
    <li>List & Add</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <!-- box-header -->
    <div class="box-header with-border">
      <h3 class="box-title">Data Jenis Artefak</h3>
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
        <form role="form" method="POST" action="{{ url('/jenis') }}">
        {!! csrf_field() !!}
        <div class="col-md-12">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="namaPropinsi">Tambah Jenis Artefak</label>
             <input type="text" class="form-control" placeholder="Jenis Artefak" name="name" value="{{ old('name') }}" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
             @if ($errors->has('name'))
                 <span class="help-block">
                     <strong>{{ $errors->first('name') }}</strong>
                 </span>
             @endif
         </div>
       </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="exampleInputPassword1">Keterangan</label>
              <textarea class="textarea" name="information" placeholder="Keterangan Jenis Artefak" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('uraian') }}</textarea>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
               <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Simpan</button>
               <a href=""><button type="button" class="btn btn-default">Cancel</button></a>
             </div>
          </div>
        </form>
      </div>

      <div class="col-md-8">
        <div class="table-responsive">
          <table id="example2" class="table table-hover table-condensed table-bordered">
            <thead>
            <tr>
              <th><div align="center">Nomer</div></th>
              <th>Jenis Artefak</th>
              <th>Kode</th>
              <th width="50%">Keterangan</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1;?>
             @foreach ($data as $type)
            <tr>
            <td class="table-text">
                <div><?php echo $i;?></div>
            </td>
            <td class="table-text">
                <div>{{ $type->name }}</div>
            </td>
            <td class="table-text">
                <div>{{ $type->id }}</div>
            </td>
            <td class="table-text">
                <div>{!! $type->information !!}</div>
            </td>
            <td align="center">
            <div class="btn-group" role="group" aria-label="...">
              <a href="{{ url('/jenis/'.$type->id.'/edit') }}"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> Ubah</button></a>
              <a href="{{ url('/jenis/'.$type->id.'/delete') }}"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"> </span> Hapus</button></a>
            </div>
            </td>
          </tr>
          <?php $i++;?>
             @endforeach
          </tbody>
          <tfoot>
        </tfoot>
          </table>
        </div>
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
