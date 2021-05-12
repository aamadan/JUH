 <aside class="main-sidebar sidebar-dark-success elevation-4" style="background-color: #276ab4;color: white;">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link" style="color: white;text-align: center;">
      <img src="app_images/ma_logo.png" alt="AdminLTE Logo" class="brand-image">
      <span class="brand-text font-weight-light" style="font-size: 13pt;">Mahuran Polyclinic</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link anchor-active active" style="color:white;">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <?php
            include 'lib/conn.php';          
            $menusql="SELECT m.name, m.icon FROM menu m INNER join sidebar s ON s.menu_id=m.id INNER JOIN permission p on s.id=p.sidebar_id where p.user ='$_SESSION[user_id]' group by m.name ORDER BY m.id ";
            $menures=$conn->query($menusql);
            while ($menurow=$menures->fetch_assoc()) {
          ?>
          <li class="nav-item">
            <a href="#" class="nav-link anchor-active" style="color:white;">
              <i class="nav-icon <?php echo $menurow['icon']?>"></i>
              <p>
                <?php echo $menurow['name']?>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php
                $submenusql="SELECT s.text, s.href FROM menu m INNER join sidebar s ON s.menu_id=m.id INNER JOIN permission p on s.id=p.sidebar_id where p.user ='$_SESSION[user_id]' and m.name = '$menurow[name]' ORDER BY s.id";
                $submenures=$conn->query($submenusql);
                if (!$submenures) {
                  echo $conn->error;
                }
                while ($submenurow=$submenures->fetch_assoc()) {
              ?>
              <li class="nav-item">
                <a href="<?php echo $submenurow['href']?>" class="nav-link sys-forms">
                  <i class="far fa-circle nav-icon"></i>
                  <p><?php echo $submenurow['text']?></p>
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
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>