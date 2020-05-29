<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title_header ?></title>
  <link rel="icon" href="<?= base_url() ?>assets/img/logo/logo.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <!-- Tags -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/tags/css/bootstrap-tagsinput.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
  <style type="text/css">
    .img-wraps {
    position: relative;
    display: inline-block;
   
    font-size: 0;
    }
    .img-wraps .closes {
        position: absolute;
        top: 5px;
        right: 8px;
        z-index: 100;
        background-color: #FFF;
        padding: 4px 3px;
        
        color: #000;
        font-weight: bold;
        cursor: pointer;
       
        text-align: center;
        font-size: 22px;
        line-height: 10px;
        border-radius: 50%;
        border:1px solid red;
    }
    .img-wraps:hover .closes {
        opacity: 1;
    }
    .note-icon-picture{
      display: none;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= site_url() ?>" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <ul class="navbar-nav ml-auto">
      <!-- logout -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?= site_url('logout') ?>" class="dropdown-item">
            Logout
            <span class="float-right text-muted text-sm"><i class="fas fa-sign-out-alt"></i></span>
          </a>
        </div>
      </li>
      <!-- colour theme -->
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('backoffice/dashboard') ?>" class="brand-link">
      <img src="<?=base_url()?>assets/img/logo/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">
        Trusur Unggul Teknusa
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php if($this->fungsi->user_login()->usr_photo == 'nophoto.png') : ?>
            <img src="<?= base_url('assets/img/accounts/users/nophoto/nophoto.png') ?>" class="img-circle elevation-2" alt="User Image">
          <?php else : ?>
            <img src="<?= base_url('assets/img/accounts/users/'.$this->fungsi->user_login()->usr_photo) ?>" class="img-circle elevation-2" alt="User Image">
          <?php endif ?>
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $this->fungsi->user_login()->usr_fullname; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- MENU -->
          <li class="nav-item">
            <a href="<?= site_url('backoffice/dashboard') ?>" class="nav-link
              <?=$this->uri->uri_string() == 'backoffice/dashboard'
              || $this->uri->uri_string() == '' ? 'active' : ''; ?>
              ">
              <i class="nav-icon fas fa-th-large"></i>
              <p>
                Dashboard
              </p>
              <span class="right badge badge-danger">New</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('backoffice/slide/list') ?>" class="nav-link
              <?=$this->uri->uri_string() == 'backoffice/slide/list'
              || $this->uri->uri_string() == 'backoffice/slide/add' ? 'active' : ''; ?>
              ">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Slide
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('backoffice/blogs/list') ?>" class="nav-link
              <?=$this->uri->uri_string() == 'backoffice/blogs/list'
              || $this->uri->uri_string() == 'backoffice/blogs/add' ? 'active' : ''; ?>
              ">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Blogs
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('backoffice/message/list') ?>" class="nav-link
              <?=$this->uri->uri_string() == 'backoffice/message/list' ? 'active' : ''; ?>
              ">
              <i class="nav-icon fas fa-envelope-open-text"></i>
              <p>
                Message
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('backoffice/faqs/list') ?>" class="nav-link
              <?=$this->uri->uri_string() == 'backoffice/faqs/list' ? 'active' : ''; ?>
              ">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                FAQS
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= site_url('backoffice/clients/list') ?>" class="nav-link
              <?=$this->uri->uri_string() == 'backoffice/clients/list' ? 'active' : ''; ?>
              ">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Clients
              </p>
            </a>
          </li>
          <?php if($this->fungsi->user_login()->usr_lvl_id == '1') : ?>
            <li class="nav-header">ADMINISTRATOR</li>
            <li class="nav-item">
              <a href="<?= site_url('backoffice/users/list') ?>" class="nav-link
                <?=$this->uri->uri_string() == 'backoffice/users/list'
                || $this->uri->uri_string() == 'backoffice/users/add' ? 'active' : ''; ?>
                ">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Users
                </p>
              </a>
            </li>
          <?php endif ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <?= $contentsbackend; ?>

  <footer class="main-footer">
    Copyright &copy; <script>document.write(new Date().getFullYear());</script> | By Trusur Unggul Teknusa
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url() ?>assets/backend/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url() ?>assets/backend/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url() ?>assets/backend/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>assets/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/backend/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() ?>assets/backend/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>assets/backend/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>assets/backend/plugins/select2/js/select2.full.min.js"></script>
<!-- Tags -->
<script src="<?= base_url() ?>assets/backend/plugins/tags/js/bootstrap-tagsinput.js"></script>

<!-- search auto number 1 -->
<script type="text/javascript">
  $(document).ready(function() {
    var t = $('#example').DataTable( {
        "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0,
            "order": [[ 1, 'asc' ]]
        } ],
        
    } );
 
    t.on( 'order.dt search.dt', function () {
        t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
  } );  
</script>

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
</body>
</html>
