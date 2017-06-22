@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
            <div class="panel-heading">
                 <ol class="breadcrumb">
                  <li><a href="/">Home</a></li>
                  <li><a href="/user/">Data Pengguna</a></li>
                  <li class="active">Hapus Pengguna</li>
                </ol>
            </div>
                <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Success Message -->
                        @foreach ($data as $user)
                        <div class="alert alert-warning alert-dismissible" role="alert">
                              <strong>Warning!</strong> Apakah anda yakin akan menghapus data pengguna ini?
                        </div>
                        <div class="panel panel-default">
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
                      <div class="modal-footer">
                        <form id="formID" class="form-horizontal" role="form" method="POST" action="{{ url('/user/delete') }}">
                        {!! csrf_field() !!}
                        <a href="{{ url('user') }}"><button type="button" class="btn btn-success" data-dismiss="modal">Tidak</button></a>
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <input type="hidden" name="_method" value="DELETE">
                      </form>
                    </div>
                       @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<br>

@endsection
