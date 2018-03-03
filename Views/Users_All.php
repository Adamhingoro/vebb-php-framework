<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_TITLE; ?> | All Users</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo PUBLIC_ASSETS; ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo PUBLIC_ASSETS; ?>/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo PUBLIC_ASSETS; ?>/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo PUBLIC_ASSETS; ?>/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo PUBLIC_ASSETS; ?>/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <?php include("Header.php"); ?>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
 
  <?php include("Sidebar.php"); ?>
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Users
        <small>All Users are Listed Here.</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo url_to("Dashboard"); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-body">
                          <?php if(isset($_SESSION['FLASH_SUCCESS'])){ ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i>Success..!</h4>
                <?php echo $_SESSION['FLASH_SUCCESS']; unset($_SESSION['FLASH_SUCCESS']); ?></div><?php } ?>
                
                
                <?php if(isset($_SESSION['FLASH_ERROR'])){ ?>
              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-warning"></i>Error..!</h4>
                <?php echo $_SESSION['FLASH_ERROR']; unset($_SESSION['FLASH_ERROR']); ?></div><?php } ?>
          <table class="table table-striped">
                <tbody><tr>
                  <th style="width: 10px">#</th>
                  <th>Name ( Email )</th>
                  <th>Role</th>
                  <th style="width: 70px">Actions</th>
                </tr>
                <?php
                if(isset($model['users']))
                {
                  
                  foreach($model['users'] as $user )
                  {
                ?>
                <tr>
                  <td><?php echo $user['id']; ?></td>
                  <td><?php echo $user['name']; ?> ( <?php echo $user['email']; ?> )</td>
                  <td>
                    <?php echo $users_model->get_role_name($user['role']);?>
                  </td>
                  <td><a href="<?php echo url_to(array("Users","Edit",$user['id'])); ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a><a href="<?php echo url_to(array("Users","Delete",$user['id'])); ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a></td>
                </tr>
                
                <?php } } ?>
              </tbody></table>
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include("Footer.php"); ?>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo PUBLIC_ASSETS; ?>/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo PUBLIC_ASSETS; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo PUBLIC_ASSETS; ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo PUBLIC_ASSETS; ?>/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo PUBLIC_ASSETS; ?>/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo PUBLIC_ASSETS; ?>/dist/js/demo.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
</body>
</html>
