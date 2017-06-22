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
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-md-4 control-label">Password Lama</label>
                            <div class="input-group col-md-6">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span></div>
                                <input type="password" class="form-control" name="currentPassword" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
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
                                    <i class="fa fa-btn fa-save"></i>Simpan Perubahan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
