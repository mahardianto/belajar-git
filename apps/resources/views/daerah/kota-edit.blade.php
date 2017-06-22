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
    <li><i class="fa fa-map"></i> Kota</li>
    <li>List & Edit</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box">
    <!-- box-header -->
    <div class="box-header with-border">
      <h3 class="box-title">Edit Data Kabupaten/Kota</h3>
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
        <form role="form" method="POST" action="{{ url('/kabupaten-kota/edit') }}">
        {!! csrf_field() !!}
        <div class="form-group">
          <label for="exampleInputPassword1">Nama Provinsi</label>
                <select class="form-control select2" name="propinsi" style="width: 100%;" required>
                  @foreach ($provinces as $province)
                    @if ( $province_id == ($province->id) )
                        <option value="{{ $province->id }}" selected>{{ $province->name }}</option>
                    @else
                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                    @endif
                  @endforeach
                </select>
        </div>
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="namaPropinsi">Edit Nama Kabupaten/Kota</label>
             <input type="text" class="form-control" placeholder="Nama Kabupaten/Kota" name="name" value="{{ $city_name }}" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
             @if ($errors->has('name'))
                 <span class="help-block">
                     <strong>{{ $errors->first('name') }}</strong>
                 </span>
             @endif
         </div>
         <div class="form-group">
            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Simpan</button>
            <a href=""><button type="button" class="btn btn-default">Cancel</button></a>
            <input type="hidden" name="id" value="{{ $id }}">
            <input type="hidden" name="_method" value="PUT">
          </div>
        </form>
      </div>

      <div class="col-md-8">
        <div class="table-responsive">
          <table id="example2" class="table table-hover table-condensed table-bordered">
            <thead>
            <tr>
              <th><div align="center">Nomer</div></th>
              <th>Nama Kota/Kabupaten</th>
              <th>Provinsi</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1;?>
             @foreach ($cities as $city)
            <tr>
            <td class="table-text">
                <div><?php echo $i;?></div>
            </td>
            <td class="table-text">
                <div>{{ $city->name }}</div>
            </td>
            <td class="table-text">
                <div>{{ $city->province->name }}</div>
            </td>
            <td align="right">
            <div class="btn-group" role="group" aria-label="...">
              <a href="{{ url('/kabupaten-kota/'.$city->id.'/edit') }}"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> Ubah</button></a>
              <a href="{{ url('/kabupaten-kota/'.$city->id.'/delete') }}"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"> </span> Hapus</button></a>
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
