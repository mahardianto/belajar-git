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
      <h3 class="box-title">Hapus Data Pengguna</h3>
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

          <div class="table-responsive">
            @foreach ($data as $user)
            <table class="table table-hover table-condensed">
              <tbody>
                <tr>
                  <th class="col-md-3">Nama Pengguna</th>
                  <td>{{ $user->name }}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>{{ $user->email }}</td>
                </tr>
                <tr>
                  <th>Nama Lengkap</th>
                  <td>{{ $user->nama_lengkap }}</td>
                </tr>
                <tr>
                  <th>NIP</th>
                  <td>{{ $user->nip }}</td>
                </tr>
                <tr>
                  <th>Level</th>
                  <td>@if (($user->level)==1)
                          Kurator
                      @elseif (($user->level)==2)
                          Registrar
                      @endif
                  </td>
                </tr>
              </tbody>
            </table>
            @endforeach
          </div>

        </div>
    <!-- /.box-body -->
    <form role="form" method="POST" action="{{ url('/user/delete') }}">
    {!! csrf_field() !!}
        <div class="box-footer">
            <a href="{{ url('user/remove') }}"><button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button></a>
            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            <input type="hidden" name="id" value="{{ $user->id }}">
            <input type="hidden" name="_method" value="DELETE">
        </div>
    </form>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->
</section>

@endsection
