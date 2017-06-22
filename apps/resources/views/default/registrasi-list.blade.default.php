@extends('layouts.app')
@section('content')
<div class="container">
        <div class="panel panel-default">
          <div class="panel-heading">
             <ol class="breadcrumb">
              <li><a href="/">Home</a></li>
              <li><a href="/registrasi/">Data Registrasi</a></li>
            </ol>
          </div>
            <div class="panel-body">
<!--              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif -->
                <table class="table table-condensed table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Nomer</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Tgl Perolehan</th>
                        <th>Asal Perolehan</th>
                        <th>Cara Perolehan</th>
                        <th>Berita Acara</th>
                        <th>Opsi</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                      <?php $i=1;?>
                         @foreach ($data as $koleksi)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div><?php echo $i;?></div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $koleksi->nama }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $koleksi->tipe }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $koleksi->tgl_perolehan }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $koleksi->asal_perolehan }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $koleksi->cara_perolehan }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $koleksi->bast }}</div>
                                </td>
                                <td>
                                  <div class="btn-group" role="group" aria-label="...">
                                    <a href="{{ url('registrasi/'.$koleksi->id.'/edit') }}"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> </span> Ubah</button></a>
                                    <a href="{{ url('registrasi/'.$koleksi->id.'/detail') }}"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"> </span> Detail</button></a>
                                    <a href="{{ url('registrasi/'.$koleksi->id.'/delete') }}"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"> </span> Hapus</button></a>
                                  </div>
                                </td>
                            </tr>
                            <?php $i++;?>
                        @endforeach
                    </tbody>
                </table>
                <div class="modal-footer">
                  <div class="btn-group" role="group" aria-label="...">
                     <a href="{{ url('registrasi/add') }}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"> </span> Data Registrasi</button></a>
                   </div>
                </div>
            </div>
        </div>
</div>
@endsection
