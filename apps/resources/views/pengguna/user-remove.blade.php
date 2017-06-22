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
    <li> Hapus</li>
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
      <h3 class="box-title">Data Pengguna</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>
    </div>

      <div class="box-body table-responsive">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check"></i> Success!</h4>
                {{ session('status') }}
            </div>
        @elseif (session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    {{ session('error') }}
                </div>
        @endif
        <table class="table table-striped task-table">

            <!-- Table Headings -->
            <thead>
                <th>Nomer</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Email</th>
                <th>Level</th>
                <th>Opsi</th>
            </thead>

            <!-- Table Body -->
            <tbody>
              <?php $i=1;?>
                  @foreach ($pengguna as $user)
                  <tr>
                      <!-- Task Name -->
                      <td class="table-text">
                          <div><?php echo $i;?></div>
                      </td>
                      <td class="table-text">
                          <div>{{ $user->nama_lengkap }}</div>
                      </td>
                      <td class="table-text">
                          <div>{{ $user->nip }}</div>
                      </td>
                        <td class="table-text">
                            <div>{{ $user->email }}</div>
                        </td>
                        <td class="table-text">
                            <div>
                              @if (($user->level)==1)
                                  Kurator
                              @elseif (($user->level)==2)
                                  Registrar
                              @endif
                            </div>
                        </td>
                        <td>
                        <div class="btn-group" role="group" aria-label="...">
                          <a href="{{ url('/user/'.$user->id.'/delete') }}"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"> </span> Hapus</button></a>
                        </div>
                        </td>
                    </tr>
                <?php $i++;?>
                    @endforeach
            </tbody>
        </table>
      </div>

    <!-- /.box-body -->
    <div class="box-footer">
      Footer
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->
</section>
@endsection
