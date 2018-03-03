<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APP_TITLE; ?> | <?php echo $model['page_title']; ?></title>
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
        <small>Add new user.</small>
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
          <form role="form" action="<?php echo url_to(array("Users","Add")); ?>" method="post">
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
                
                <div class="form-group">
                  <label for="fullname">Full Name</label>
                  <input class="form-control" id="fullname" name="fullname" placeholder="Abdul Bari" type="text">
                </div>
                
                <div class="form-group">
                  <label for="email">Email address</label>
                  <input class="form-control" id="email" name="email" placeholder="Enter email" type="email">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input class="form-control" name="password" id="password" placeholder="Password" type="password">
                </div>
                
                <div class="form-group">
                  <label for="cpassword">Confirm Password</label>
                  <input class="form-control" name="cpassword" id="cpassword" placeholder="Password" type="password">
                </div>
                
                <div class="form-group">
                  <label for="role">Role</label>
                  <select class="form-control" name="role" id="role">
                    <option value="0">Super Administrator</option>
                    <option value="1">Sales Manager</option>
                    <option value="2">Hr Manager</option>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Add new user</button>
              </div>
            </form>
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
