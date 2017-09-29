<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title>PropertyMedia</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <!-- jquery -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>

  </head>

  <body class="fixed-nav sticky-footer bg-dark" id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="/admin/">PropertyMedia</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <?php 
            if (isset($_GET["menu"])) {
                $menu = $_GET["menu"];
                $uri = explode("/", $menu);
                $uri = $uri[0];
            } else {
                $uri = "";
            }
         ?>
          <li class="nav-item <?php echo !isset($menu) ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="/admin/">
              <i class="fa fa-fw fa-dashboard"></i>
              <span class="nav-link-text">
                Dashboard</span>
            </a>
          </li>

          <li class="nav-item <?php echo $uri == 'pemesanan' ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Pemesanan">
            <a class="nav-link" href="?menu=pemesanan">
              <i class="fa fa-money"></i>&nbsp;
              <span class="nav-link-text">
                Pemesanan</span>
            </a>
          </li>

          <li class="nav-item <?php echo $uri == 'penjualan' ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Pemesanan">
            <a class="nav-link" href="?menu=penjualan">
              <i class="fa fa-credit-card"></i>&nbsp;
              <span class="nav-link-text">
                Transaksi Penjualan</span>
            </a>
          </li>

          <li class="nav-item <?php echo $uri == 'pembeli' ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Data Pembeli">
            <a class="nav-link" href="?menu=pembeli">
              <i class="fa fa-user"></i>&nbsp;&nbsp;
              <span class="nav-link-text">
                Data Pembeli</span>
            </a>
          </li>
		  
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Produk Rumah">
            <a class="nav-link nav-link-collapse <?php if($uri == 'rumah_kategori' || $uri == 'rumah') { echo '';} else { echo 'collapsed'; } ?>" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
              <i class="fa fa-home"></i>&nbsp;
              <span class="nav-link-text">
                Produk Rumah</span>
            </a>
              <ul class="sidenav-second-level collapse <?php if($uri == 'rumah_kategori' || $uri == 'rumah') { echo 'show';} ?> " id="collapseExamplePages">
                <li class="nav-item <?php echo $uri == 'rumah_kategori' ? 'active' : ''; ?>">
                  <a href="?menu=rumah_kategori">
                    <i class="fa fa-dot-circle-o"></i>
                    Kategori
                  </a>
                </li>
                <li class="nav-item <?php echo $uri == 'rumah' ? 'active' : ''; ?>">
                  <a href="?menu=rumah">
                    <i class="fa fa-dot-circle-o"></i>
                    Rumah
                  </a>
                </li>
              </ul>
          </li>
      
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Settings">
            <a class="nav-link nav-link-collapse <?php if($uri == 'about' || $uri == 'contact' || $uri == 'sosmed') { echo '';} else { echo 'collapsed'; } ?>" data-toggle="collapse" href="#settings" data-parent="#settings">
              <i class="fa fa-gears"></i>&nbsp;
              <span class="nav-link-text">
                Settings</span>
            </a>
              <ul class="sidenav-second-level collapse <?php if($uri == 'about' || $uri == 'contact' || $uri == 'sosmed') { echo 'show';} ?> " id="settings">
                <li class="nav-item <?php echo $uri == 'about' ? 'active' : ''; ?>">
                  <a href="?menu=about">
                    <i class="fa fa-dot-circle-o"></i>
                    Tentang Kami
                  </a>
                </li>
                <li class="nav-item <?php echo $uri == 'contact' ? 'active' : ''; ?>">
                  <a href="?menu=contact">
                    <i class="fa fa-dot-circle-o"></i>
                    Kontak
                  </a>
                </li>
                <li class="nav-item <?php echo $uri == 'sosmed' ? 'active' : ''; ?>">
                  <a href="?menu=sosmed">
                    <i class="fa fa-dot-circle-o"></i>
                    Sosial Media
                  </a>
                </li>
              </ul>
          </li>
		  
          <li class="nav-item <?php echo $uri == 'users' ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Users">
            <a class="nav-link" href="?menu=users">
              <i class="fa fa-users"></i>&nbsp;
              <span class="nav-link-text">
                Users</span>
            </a>
          </li>
        </ul>
        <!-- End menu side -->

        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>

        <!-- For menu Head -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a href="?menu=users/profile" class="nav-link">
              <i class="fa fa-user"></i>
              <?php 
                  $model = new Model_mysqli();
                  $model->setTable("users");

                  $adminNama = $model->getById($admin["id"]);
                  echo $adminNama["nama"]; 
              ?>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
              <i class="fa fa-fw fa-sign-out"></i>
              Logout</a>
          </li>
        </ul>
        <!-- End menu head -->

      </div>
    </nav>

    <div class="content-wrapper">

      <div class="container-fluid">