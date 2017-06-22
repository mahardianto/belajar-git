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
                  <li>Ubah Data Pengguna</li>
                </ol>
              </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/user/edit') }}">
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
                            <label class="col-md-4 control-label">Level Pengguna</label>
                            <div class="input-group col-md-6">
                              <select name="level" required>
                                @if (($user->level)==1)
                                    <option value="1" selected>Kurator</option>
                                    <option value="2">Registrar</option>
                                @elseif (($user->level)==2)
                                    <option value="1">Kurator</option>
                                    <option value="2" selected>Registrar</option>
                                @endif
                              </select>
                             </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Nama</label>
                              <div class="input-group col-md-6">
                                  <div class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"> </span></div>
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>

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
                                <input type="text" class="form-control"  name="nama_lengkap" value="{{ $user->nama_lengkap }}" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
                             </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">NIP</label>
                            <div class="input-group col-md-6">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"> </span></div>
                                <input type="number" class="form-control"  name="nip" value="{{ $user->nip }}" required>
                             </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Alamat E-Mail</label>

                            <div class="input-group col-md-6">
                              <div class="input-group-addon"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span></div>
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"> </span>
                                    <i class="fa fa-btn fa-user"></i> Simpan Perubahan
                                </button>
                                <a href="{{ url('user/'.$user->id.'/edit/password') }}">
                                <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-lock" aria-hidden="true"> </span>
                                    <i class="fa fa-btn fa-user"></i> Ubah Password
                                </button>
                              </a>
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
