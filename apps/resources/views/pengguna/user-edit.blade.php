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
    <li> Ubah Data User</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <div class="box box-default">
    <div class="box-header with-border">
      <h3 class="box-title">Ubah Data User</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>
    <form role="form" method="POST" action="{{ url('/user/edit') }}">
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
              @foreach ($data as $user)
              <div class="form-group col-md-5">
              <div class="form-group">
                <label for="exampleInputPassword1">Level Pengguna</label>
                      <select class="form-control select2" name="level" style="width: 100%;" required>
                        @if (($user->level)==1)
                            <option value="1" selected>Kurator</option>
                            <option value="2">Registrar</option>
                        @elseif (($user->level)==2)
                            <option value="1">Kurator</option>
                            <option value="2" selected>Registrar</option>
                        @endif
                      </select>
              </div>
                <div class="form-group">
                  <label for="namaBendaKoleksi">Nama Pengguna</label>
                   <input type="text" class="form-control" placeholder="Nama Pengguna" name="name" value="{{ $user->name }}" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
               </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Nama Lengkap Pegawai</label>
                  <input type="text" class="form-control" placeholder="Nama Lengkap Pegawai" name="nama_lengkap" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" value="{{ $user->nama_lengkap }}" required>
                </div>
                <div class="form-group">
                      <label for="exampleInputPassword1">NIP</label>
                      <input type="text" class="form-control" placeholder="Nomer Induk Pegawai" name="nip" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" value="{{ $user->nip }}" required>
                </div>
                <div class="form-group">
                      <label for="exampleInputPassword1">Alamat Email (User Login)</label>
                      <input type="email" class="form-control" placeholder="Email Pegawai" name="email" value="{{ $user->email }}" disabled>
                </div>
              </div>
          <!-- Tambahan -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Simpan</button>
        <a href="{{ url('/user/'.$user->id.'/edit/password') }}">
        <button type="button" class="btn btn-default">
            <i class="fa fa-btn fa-key"></i> Ubah Password
        </button>
      </a>
      </div>
      <input type="hidden" name="id" value="{{ $user->id }}">
      <input type="hidden" name="_method" value="PUT">
      @endforeach
      </form>
  <!--   </form> -->
  </div>
  <!-- /.box -->
</section>
@endsection
