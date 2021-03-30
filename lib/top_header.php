<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <img src="app_images/banner.png"  alt="AdminLTE Logo" class="brand-image">
      </a>
      
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse " id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="sys_forms/frm_patientVisits.php" class="nav-link sys-forms">Clinical Management</a>
          </li>
         
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="navbar-nav navbar-no-expand ml-auto"> 
        <li class="nav-item dropdown user-menu">
          <?php 
            include "lib/conn.php";
            $sql="call sp_interface_design('$_SESSION[user_type]','$_SESSION[user_id]')";
            $res=$conn->query($sql);
            $row=$res->fetch_assoc();
          ?>
          <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo $row['img'];?>" class="user-image img-circle elevation-1" alt="User Image">
            <span class="d-none d-md-inline"><?php echo $row['username'];?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="background-color: #276AB4;color:white;">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php echo $row['img'];?>" class="img-circle elevation-2" alt="User Image">

              <p>
                <?php echo $row['name'];?>
                <b><br><?php echo $row['usertype'];?></b>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <a href="lib/logout.php" class="btn btn-flat float-right btn-block" style="background-color: #276AB4;color:white"><i class="fas fa-sign-out-alt"></i> Sign out</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>