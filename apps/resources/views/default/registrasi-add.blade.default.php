@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
              <div class="panel-heading">
                     <ol class="breadcrumb">
                      <li><a href="/">Home</a></li>
                      <li><a href="/registrasi/">Data Registrasi</a></li>
                      <li class="active">Tambah Data Registrasi</li>
                    </ol>
              </div>
                <div class="panel-body">
                    <form id="formID" class="form-horizontal" role="form" method="POST" action="{{ url('/registrasi/add') }}">
                        {!! csrf_field() !!}
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Success Message -->
                       <div class="form-group">
                           <label class="col-md-4 control-label">Nama Benda Koleksi</label>
                           <div class="input-group col-md-6">
                               <input type="text" class="form-control"  name="nama" value="" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
                            </div>
                       </div>
                       <div class="form-group">
                           <label class="col-md-4 control-label">Tipe Benda</label>
                           <div class="btn-group col-md-6" role="group" aria-label="cara_perolehan">
                               <div class="radio">
                                 <label>
                                   <input type="radio" name="tipe_benda" id="optionsRadios" value="Media Cetak" required>
                                   Arsip Media Cetak
                                 </label>
                               </div>
                               <div class="radio">
                                 <label>
                                   <input type="radio" name="tipe_benda" id="optionsRadios" value="Benda Pers" required>
                                   Benda Pers Bersejarah
                                 </label>
                               </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="col-md-4 control-label">Tanggal perolehan</label>
                           <div class="input-group col-md-2">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"> </span> </div>
                               <input type="text" class="form-control" id="tgl_perolehan" name="tgl_perolehan" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required>
                            </div>
                       </div>
                       <div class="form-group">
                           <label class="col-md-4 control-label">Asal Daerah Perolehan</label>
                           <div class="input-group col-md-6">
                             <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"> </span> </div>
                               <input type="text" class="form-control" name="asal_perolehan" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" value="" required>
                            </div>
                       </div>
                          <div class="form-group">
                            <label class="col-md-4 control-label">Ukuran Panjang x Lebar x Tinggi</label>
                            <div class="col-md-6 input-group">
                              <input type="number" class="form-control" name="panjang" min="0" placeholder="Panjang" required>
                              <div class="input-group-addon">mm</div>
                              <input type="number" class="form-control" name="lebar" min="0" placeholder="Lebar" required>
                              <div class="input-group-addon">mm</div>
                              <input type="number" class="form-control" name="tinggi" min="0" placeholder="Tinggi" required>
                              <div class="input-group-addon">mm</div>
                            </div>
                          </div>

                       <div class="form-group">
                         <label class="col-md-4 control-label">Berat </label>
                         <div class="input-group col-md-3">
                           <input type="number" class="form-control" name="berat" min="1" value="" required>
                           <div class="input-group-addon">gram</div>
                         </div>
                       </div>
                       <div class="form-group">
                           <label class="col-md-4 control-label">Cara Perolehan</label>
                           <div class="btn-group col-md-6" role="group" aria-label="cara_perolehan">
                               <div class="radio">
                                 <label>
                                   <input type="radio" name="perolehan" id="optionsRadios" value="hibah" required>
                                   Hibah
                                 </label>
                               </div>
                               <div class="radio">
                                 <label>
                                   <input type="radio" name="perolehan" id="optionsRadios" value="peminjaman" required>
                                   Peminjaman
                                 </label>
                               </div>
                               <div class="radio">
                                 <label>
                                   <input type="radio" name="perolehan" id="optionsRadios" value="pembelian" required>
                                   Pembelian
                                 </label>
                               </div>
                               <div class="radio">
                                 <label>
                                   <input type="radio" name="perolehan" id="optionsRadios" value="penggalian" required>
                                   Penggalian
                                 </label>
                               </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="col-md-4 control-label">Tanggal Masuk</label>
                           <div class="input-group col-md-2">
                             <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"> </span> </div>
                               <input type="text" id="tgl_masuk" class="form-control" name="tgl_masuk" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" required>
                            </div>
                       </div>
                       <div class="form-group">
                           <label class="col-md-4 control-label">Sejarah</label>
                           <div class="input-group col-md-6">
                             <textarea name="sejarah"></textarea>
                              <script>
                                  CKEDITOR.replace( 'sejarah', {
                                      uiColor: '#9AB8F3',
                                      height:'80'
                                  } );
                              </script>
                            </div>
                       </div>
                       <div class="form-group">
                         <label class="col-md-4 control-label">Harga Satuan</label>
                         <div class="input-group col-md-3">
                           <div class="input-group-addon">Rp.</div>
                           <input type="number" class="form-control" name="harga_satuan" value="" min="0" required>
                           <div class="input-group-addon">.00</div>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-md-4 control-label">Jumlah</label>
                         <div class="input-group col-md-3">
                           <input type="number" class="form-control" name="jumlah" min="1" value="" required>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-md-4 control-label">Keterangan</label>
                         <div class="input-group col-md-6">
                           <textarea name="keterangan"></textarea>
                            <script>
                            CKEDITOR.replace( 'keterangan', {
                                uiColor: '#9AB8F3',
                                height:'80'
                            } );
                            </script>
                         </div>
                       </div>
			                 <div class="form-group">
                           <label class="col-md-4 control-label">No. Berita Acara Serah Terima</label>
                           <div class="input-group col-md-6">
                               <input type="text" class="form-control" name="bast" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" value="" required>
                            </div>
                       </div>
		                   <div class="form-group">
                           <div class="col-md-6 col-md-offset-4">
                               <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"> </span> Simpan Data</button>
                           </div>
                       </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Datepicker -->
<script type="text/javascript">
$(function() {
    $('#tgl_perolehan').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
          format: 'YYYY-MM-DD'
      }
    });
    $('#tgl_masuk').daterangepicker({
      singleDatePicker: true,
      showDropdowns: true,
      locale: {
          format: 'YYYY-MM-DD'
      }
    });
});
</script>
<!-- DatePicker -->
@endsection
