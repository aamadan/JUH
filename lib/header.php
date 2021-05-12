  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <a href="index.php" class="navbar-brand">
      <img src="app_images/mahuran.png" alt="JUH Logo" width="200" class="brand-image">
    </a>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">    
      <li class="nav-item dropdown user-menu">
        <?php 
          include "lib/conn.php";
          $sql="call sp_interface_design('$_SESSION[user_type]','$_SESSION[user_id]')";
          $res=$conn->query($sql);
          $row=$res->fetch_assoc();
        ?>
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo $row['img'];?>" class="user-image img-circle elevation-2" alt="User Image">
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
  </nav>