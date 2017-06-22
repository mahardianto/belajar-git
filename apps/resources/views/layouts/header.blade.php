<header class="main-header">
  <!-- Logo -->
  <a href="/" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>SIDK</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>Database Koleksi</b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu"></li>
        <!-- Notifications: style can be found in dropdown.less -->
        <li class="dropdown notifications-menu"></li>
        <!-- Tasks: style can be found in dropdown.less -->
        <li class="dropdown tasks-menu"></li>
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ url('/adminlte/dist/img/avatar-2.png') }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ url('/adminlte/dist/img/avatar-2.png') }}" class="img-circle" alt="User Image">

              <p>
                <?php
                  $role=Auth::user()->level;
                  if ($role==1) {
                    $role='Kurator';
                  }
                  elseif ($role==2) {
                    $role='Registrar';
                  }
                  else {
                    $role='';
                  }
                ?>
                {{ Auth::user()->name }}
                <small>Hak Akses: {{ $role }}</small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-xs-4 text-center">
                  <a href="#"></a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#"></a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#"></a>
                </div>
              </div>
              <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="{{ url('/password') }}" class="btn btn-default btn-flat">Password</a>
              </div>
              <div class="pull-right">
                <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Log out</a>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>
