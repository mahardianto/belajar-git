@extends('layouts.dashboard')
@section('content')
<section class="content-header">
  <h1>
    Sistem Informasi Database Koleksi
    <small>Monumen Pers Nasional</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    <li><i class="fa fa-users"></i> Users</li>
    <li> Tambah User</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Tambah Data Pengguna</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- <form role="form"> -->
    <form role="form" method="POST" action="{{ url('/user/add') }}">
    {!! csrf_field() !!}
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
        <div class="row">
          <!-- Tambahan -->
              <div class="form-group col-md-5">
              <div class="form-group">
                <label for="exampleInputPassword1">Level Pengguna</label>
                      <select class="form-control select2" name="level" style="width: 100%;" required>
                        @if (old('level')==1)
                            <option value="1" selected>Kurator</option>
                            <option value="2">Registrar</option>
                        @elseif (old('level')==2)
                            <option value="1">Kurator</option>
                            <option value="2" selected>Registrar</option>
                        @else
                            <option></option>
                            <option value="1">Kurator</option>
                            <option value="2">Registrar</option>
                        @endif
                      </select>
              </div>
                <div class="form-group">
                  <label for="namaBendaKoleksi">Nama Pengguna</label>
                   <input type="text" class="form-control" placeholder="Nama Pengguna" name="name" value="{{ old('name') }}" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
               </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama Lengkap Pegawai</label>
                  <input type="text" class="form-control" placeholder="Nama Lengkap Pegawai" name="nama_lengkap" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" value="{{ old('nama_lengkap') }}" required>
                </div>
                <div class="form-group">
                      <label for="exampleInputPassword1">NIP</label>
                      <input type="text" class="form-control" placeholder="Nomer Induk Pegawai" name="nip" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" value="{{ old('nip') }}" required>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                      <label for="exampleInputPassword1">Alamat Email (User Login)</label>
                      <input type="email" class="form-control" placeholder="Email Pegawai" name="email" value="{{ old('email') }}" required>
                      @if ($errors->has('email'))
                          <span class="help-block">
                              <strong>{{ $errors->first('email') }}</strong>
                          </span>
                      @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" placeholder="Password" name="password" minlength="8" value="" required>
                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                  <label for="exampleInputPassword1">Confirmation Password</label>
                  <input type="password" class="form-control" placeholder="Verifikasi Password" name="password_confirmation" value="" required>
                  @if ($errors->has('password_confirmation'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                      </span>
                  @endif
                </div>
              </div>
          <!-- Tambahan -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>Simpan</button>
        <a href=""><button type="button" class="btn btn-default">Cancel</button></a>
      </div>
      </form>
  <!--   </form> -->
  </div>
  <!-- /.box -->
</section>
@endsection
