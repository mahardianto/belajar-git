@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <p>
                    <form action="/avatars" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <input type="file" name="registrasi" accept=".png"/><br/>
                      <input type="text" name="body"/> <br/>
                      <button type="submit" name="button">Save Avatar</button>
                    </form>
                  </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
