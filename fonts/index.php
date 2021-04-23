<?php 
session_start();
if(empty($_SESSION['user_id'])){
  header("Location: login.html"); 
}
else{
  $id=$_SESSION["user_id"];
  $usertype=$_SESSION["user_type"];
}
?>
<!DOCTYPE html>
<html>
<head>
  <?php include("lib/head.php")?>
</head>
<?php
  if ($_SESSION["user_type"] ==2) {
?>
  <body class="hold-transition layout-top-nav">
<?php
  }
  else{
?>
  <body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
<?php
  }
?>
<div class="wrapper">
  <?php 
  //<!-- Navbar -->
  if ($_SESSION["user_type"] ==1) {
    include("lib/header.php");
    include("lib/sidebar.php");
  }
  elseif ($_SESSION["user_type"] ==2) {
    include("lib/top_header.php");
  }
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="<?php echo $_SESSION['user_type']== 2 ?  'container' :  'container-fluid'?>">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" id="content-header">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item" id="dashboard-location-parent"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" id="dashboard-location-child">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" >
      <div class="<?php echo $_SESSION['user_type']== 2 ?  'container' :  'container-fluid'?>" id="content-body">

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include("lib/footer.php");?>