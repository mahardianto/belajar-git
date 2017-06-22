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
                    <li class="active">Ubah</li>
                  </ol>
            </div>
                <div class="panel-body">
                    <form id="formID" class="form-horizontal" role="form" method="POST" action="{{ url('/registrasi/edit') }}">
                        {!! csrf_field() !!}
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <!-- Success Message -->
                        @foreach ($data as $koleksi)
                        <div class="form-group">
                            <label class="col-md-4 control-label">Nama Benda Koleksi</label>
                            <div class="input-group col-md-6">
                                <input type="text" class="form-control"  name="nama" value="{{ $koleksi->nama }}" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" required>
                             </div>
                        </div>
                       <div class="form-group">
                           <label class="col-md-4 control-label">Tipe Benda</label>
                           <div class="btn-group col-md-6" role="group" aria-label="tipe">
                               <div class="radio">
                                <!-- Masih Belum bisa selected -->
                                 <label>
                                   @if (($koleksi->tipe)=='Media Cetak')
                                       <input type="radio" name="tipe_benda" id="optionsRadios" value="Media Cetak" checked>
                                   @else
                                       <input type="radio" name="tipe_benda" id="optionsRadios" value="Media Cetak">
                                   @endif
                                   Arsip Media Cetak
                                 </label>
                               </div>
                               <div class="radio">
                                 <label>
                                   @if (($koleksi->tipe)=='Benda Pers')
                                   <input type="radio" name="tipe_benda" id="optionsRadios" value="Benda Pers" checked>
                                   @else
                                   <input type="radio" name="tipe_benda" id="optionsRadios" value="Benda Pers">
                                   @endif
                                   Benda Pers Bersejarah
                                 </label>
                               </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="col-md-4 control-label">Tanggal perolehan</label>
                           <div class="input-group col-md-2">
                                <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"> </span> </div>
                               <input id="tgl_perolehan" type="text" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" class="form-control"  value="{{ $koleksi->tgl_perolehan }}" name="tgl_perolehan" required>
                            </div>
                       </div>

                       <div class="form-group">
                           <label class="col-md-4 control-label">Asal Daerah Perolehan</label>
                           <div class="input-group col-md-6">
                             <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"> </span> </div>
                               <input type="text" class="form-control" name="asal_perolehan" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" value="{{ $koleksi->asal_perolehan }}" required>
                            </div>
                       </div>
                       <div class="form-group">
                         <label class="col-md-4 control-label">Ukuran Panjang x Lebar x Tinggi</label>
                         <div class="col-md-6 input-group">
                           <input type="number" class="form-control" name="panjang" min="1" placeholder="Panjang" value="{{ $koleksi->panjang }}" required>
                           <div class="input-group-addon">mm</div>
                           <input type="number" class="form-control" name="lebar" min="1" placeholder="Lebar" value="{{ $koleksi->lebar }}"required>
                           <div class="input-group-addon">mm</div>
                           <input type="number" class="form-control" name="tinggi" placeholder="Tinggi" value="{{ $koleksi->tinggi }}"required>
                           <div class="input-group-addon">mm</div>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-md-4 control-label">Berat </label>
                         <div class="input-group col-md-3">
                           <input type="number" class="form-control" name="berat" min="1" value="{{ $koleksi->berat }}" required>
                           <div class="input-group-addon">gram</div>
                         </div>
                       </div>
                       <div class="form-group">
                           <label class="col-md-4 control-label">Cara Perolehan</label>
                           <div class="btn-group col-md-6" role="group" aria-label="cara_perolehan">
                               <div class="radio">
                                 <label>
                                   @if (($koleksi->cara_perolehan)=='hibah')
                                   <input type="radio" name="perolehan" id="optionsRadios" value="hibah" checked>
                                   @else
                                   <input type="radio" name="perolehan" id="optionsRadios" value="hibah">
                                   @endif
                                   Hibah
                                 </label>
                               </div>
                               <div class="radio">
                                 <label>
                                   @if (($koleksi->cara_perolehan)=='peminjaman')
                                   <input type="radio" name="perolehan" id="optionsRadios" value="peminjaman" checked>
                                   @else
                                   <input type="radio" name="perolehan" id="optionsRadios" value="peminjaman">
                                   @endif
                                   Peminjaman
                                 </label>
                               </div>
                               <div class="radio">
                                 <label>
                                   @if (($koleksi->cara_perolehan)=='pembelian')
                                   <input type="radio" name="perolehan" id="optionsRadios" value="pembelian" checked>
                                   @else
                                   <input type="radio" name="perolehan" id="optionsRadios" value="pembelian">
                                   @endif
                                   Pembelian
                                 </label>
                               </div>
                               <div class="radio">
                                 <label>
                                   @if (($koleksi->cara_perolehan)=='penggalian')
                                   <input type="radio" name="perolehan" id="optionsRadios" value="penggalian" checked>
                                   @else
                                   <input type="radio" name="perolehan" id="optionsRadios" value="penggalian">
                                   @endif
                                   Penggalian
                                 </label>
                               </div>
                           </div>
                       </div>
                       <div class="form-group">
                           <label class="col-md-4 control-label">Tanggal Masuk</label>
                           <div class="input-group col-md-2">
                             <div class="input-group-addon"><span class="glyphicon glyphicon-calendar" aria-hidden="true"> </span> </div>
                               <input id="tgl_masuk" type="text" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" class="form-control" value="{{ $koleksi->tgl_masuk }}" name="tgl_masuk" required>
                            </div>
                       </div>

                       <div class="form-group">
                           <label class="col-md-4 control-label">Sejarah</label>
                           <div class="input-group col-md-6">
                             <textarea name="sejarah">{{ $koleksi->sejarah }}</textarea>
                              <script>
                                  CKEDITOR.replace( 'sejarah', {
                                      uiColor: '#9AB8F3'
                                  } );
                              </script>
                            </div>
                       </div>
                       <div class="form-group">
                         <label class="col-md-4 control-label">Harga Satuan</label>
                         <div class="input-group col-md-3">
                           <div class="input-group-addon">Rp.</div>
                           <input type="number" class="form-control" name="harga_satuan" value="{{ $koleksi->harga_satuan }}" min="0" required>
                           <div class="input-group-addon">.00</div>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-md-4 control-label">Jumlah</label>
                         <div class="input-group col-md-3">
                           <input type="number" class="form-control" name="jumlah" min="1" value="{{ $koleksi->jumlah }}" required>
                         </div>
                       </div>
                       <div class="form-group">
                         <label class="col-md-4 control-label">Keterangan</label>
                         <div class="input-group col-md-6">
                           <textarea name="keterangan">{{ $koleksi->keterangan }}</textarea>
                            <script>
                            CKEDITOR.replace( 'keterangan', {
                                uiColor: '#9AB8F3'
                            } );
                            </script>
                         </div>
                       </div>
			                 <div class="form-group">
                           <label class="col-md-4 control-label">No. Berita Acara Serah Terima</label>
                           <div class="input-group col-md-6">
                               <input type="text" class="form-control" name="bast" pattern="([a-zA-Z0-9]| |/|\|@|#|$|%|&)+" value="{{ $koleksi->bast }}" required>
                            </div>
                       </div>
		                  <div class="form-group">
                           <div class="col-md-6 col-md-offset-4">
                               <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"> </span> Simpan Perubahan</button>
                           </div>
                       </div>
                        <input type="hidden" name="id" value="{{ $koleksi->id }}">
                       @endforeach
                       <input type="hidden" name="_method" value="PUT">
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
