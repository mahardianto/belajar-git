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
                  <li>Tambah Pengguna</li>
                </ol>
              </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/add') }}">
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
                        <div class="form-group">
                            <label class="col-md-4 control-label">Level Pengguna</label>
                            <div class="input-group col-md-6">
                              <select name="level" required>
                                  <option></option>
                                  <option value="1">Kurator</option>
                                  <option value="2">Registrar</option>
                              </select>
                             </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nama</label>
                              <div class="input-group col-md-6">
                                  <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"> </span></div>
                                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nama Lengkap</label>
                            <div class="input-group col-md-6">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"> </span></div>
                                <input type="text" class="form-control"  name="nama_lengkap" value="" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
                             </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">NIP</label>
                            <div class="input-group col-md-6">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"> </span></div>
                                <input type="number" class="form-control"  name="nip" value="" required>
                             </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Alamat E-Mail</label>

                            <div class="input-group col-md-6">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span></div>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="input-group col-md-6">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span></div>
                                <input type="password" class="form-control" name="password" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Konfirmasi Password</label>

                            <div class="input-group col-md-6">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span></div>
                                <input type="password" class="form-control" name="password_confirmation" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"> </span>
                                    <i class="fa fa-btn fa-user"></i> Simpan Data Pengguna
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
