<!-- Left side column. contains the sidebar -->

<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ url('/adminlte/dist/img/avatar-2.png') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
      </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="treeview">
        <a href="{{ url('/home') }}">
          <i class="fa fa-dashboard"></i><span>Dashboard</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-book"></i>
          <span>Registrasi</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/registrasi') }}"><i class="fa fa-circle-o text-aqua"></i> List Data</a></li>
          <li><a href="{{ url('/registrasi/add/') }}"><i class="fa fa-circle-o text-yellow"></i> Tambah Data</a></li>
          <li><a href="{{ url('/registrasi/remove/') }}"><i class="fa fa-circle-o text-red"></i> Hapus Data</a></li>
        </ul>
      </li>
      <!-- MultiLevel -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-database"></i> <span>Inventaris</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="#"><i class="fa fa-circle-o text-green"></i> Artefak
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{ url('/artefak') }}"><i class="fa fa-circle-o text-aqua"></i> List Data</a></li>
              <li><a href="{{ url('/artefak/add/') }}"><i class="fa fa-circle-o text-yellow"></i> Tambah Data</a></li>
              <li><a href="{{ url('/artefak/delete') }}"><i class="fa fa-circle-o text-red"></i> Hapus Data</a></li>
            </ul>
          </li>
          <li>
            <a href="#"><i class="fa fa-circle-o text-green"></i> Media Cetak
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> List Data
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Koran</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Majalah</a></li>
                  </ul>
              </li>
              <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Tambah Data</a></li>
              <li><a href="#"><i class="fa fa-circle-o text-red"></i> Hapus Data
                      <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Koran</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Majalah</a></li>
                  </ul>
        </li>
            </ul>
          </li>
        </ul>
      </li>
      <!-- MultiLevel -->
      <li class="treeview">
        <a href="#">
          <i class="fa fa-map"></i>
          <span>Lokasi Daerah</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/provinsi') }}"><i class="fa fa-circle-o text-aqua"></i> Propinsi</a></li>
          <li><a href="{{ url('/kabupaten-kota') }}"><i class="fa fa-circle-o text-aqua"></i> Kabupaten / Kota</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-archive"></i>
          <span>Penyimpanan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/ruang') }}"><i class="fa fa-circle-o text-aqua"></i> Ruang</a></li>
          <li><a href="{{ url('/rak') }}"><i class="fa fa-circle-o text-aqua"></i> Rak</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder"></i>
          <span>Klasifikasi Artefak</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ url('/jenis') }}"><i class="fa fa-circle-o text-aqua"></i> Jenis</a></li>
          <li><a href="{{ url('/bentuk') }}"><i class="fa fa-circle-o text-aqua"></i> Sub Jenis</a></li>
        </ul>
      </li>
  </section>
  <!-- /.sidebar -->
</aside>
