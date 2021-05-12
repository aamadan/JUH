<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container-fluid mx-5">
      <a href="#" class="navbar-brand">
        <img src="app_images/mahuran.png"  alt="AdminLTE Logo" width="200">
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
          <?php
            include 'lib/conn.php';          
            $menusql="SELECT m.name, m.icon FROM menu m INNER join sidebar s ON s.menu_id=m.id INNER JOIN permission p on s.id=p.sidebar_id where p.user ='$_SESSION[user_id]' group by m.name ORDER BY m.id ";
            $menures=$conn->query($menusql);
            while ($menurow=$menures->fetch_assoc()) {
          ?>
          <li class="nav-item dropdown">
            <a id="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
              <?php echo $menurow['name']?>
            </a>
            <ul aria-labelledby="" class="dropdown-menu border-0 shadow">
              <?php
                $submenusql="SELECT s.text, s.href FROM menu m INNER join sidebar s ON s.menu_id=m.id INNER JOIN permission p on s.id=p.sidebar_id where p.user ='$_SESSION[user_id]' and m.name = '$menurow[name]' ORDER BY s.id";
                $submenures=$conn->query($submenusql);
                if (!$submenures) {
                  echo $conn->error;
                }
                while ($submenurow=$submenures->fetch_assoc()) {
              ?>
              <li>
                <a href="<?php echo $submenurow['href']?>" class="dropdown-item sys-forms">
                    <?php echo $submenurow['text']?>    
                </a>
              </li>
            <?php
              }
            ?>
            </ul>
          </li>
          <?php
            }
          ?>
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