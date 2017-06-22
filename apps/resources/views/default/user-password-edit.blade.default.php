@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                 <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="/user/">Data Pengguna</a></li>
                  <li>Ubah Password</li>
                </ol>
              </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/edit/password') }}">
                      <!-- Error Message -->
                      @if (session('error'))
                          <div class="alert alert-danger">
                              {{ session('error') }}
                          </div>
                      @endif
                      <!-- Error Message -->
                      <!-- Success Message -->
                      @if (session('status'))
                          <div class="alert alert-success">
                              {{ session('status') }}
                          </div>
                      @endif
                      <!-- Success Message -->
                        {!! csrf_field() !!}
                        @foreach ($data as $user)

                        <div class="form-group">
                            <label class="col-md-4 control-label">Nama Pengguna</label>
                            <div class="input-group col-md-6">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"> </span></div>
                                <input type="text" class="form-control" value="{{ $user->nama_lengkap}}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nama Email</label>
                            <div class="input-group col-md-6">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span></div>
                                <input type="text" class="form-control" value="{{ $user->email}}" disabled>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password Baru</label>
                            <div class="input-group col-md-6">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span></div>
                                <input type="password" class="form-control" name="password" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Konfirmasi Password Baru</label>

                            <div class="input-group col-md-6">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span></div>
                                <input type="password" class="form-control" name="password_confirmation" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"> </span>
                                    <i class="fa fa-btn fa-user"></i> Simpan Perubahan
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="hidden" name="_method" value="PUT">
                    @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
