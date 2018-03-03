 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="info">
          <p><h4><?php echo $_SESSION['user']['name'] ?></h4></p>
        </div>
      </div>
      <!-- search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i> <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo url_to(array("Users","Add")); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
            <li><a href="<?php echo url_to(array("Users","All")); ?>"><i class="fa fa-circle-o"></i> View All</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Employes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo url_to(array("Employes","Add")); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
            <li><a href="<?php echo url_to(array("Employes","All")); ?>"><i class="fa fa-circle-o"></i> View All</a></li>
            <li><a href="<?php echo url_to(array("Departments","Add")); ?>"><i class="fa fa-circle-o"></i> Add New Department</a></li>
            <li><a href="<?php echo url_to(array("Departments","All")); ?>"><i class="fa fa-circle-o"></i> View All Departments</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>Customers</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo url_to(array("Customers","Add")); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
            <li><a href="<?php echo url_to(array("Customers","All")); ?>"><i class="fa fa-circle-o"></i> View All</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i> <span>Services</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo url_to(array("Services","Add")); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
            <li><a href="<?php echo url_to(array("Services","All")); ?>"><i class="fa fa-circle-o"></i> View All</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-reorder"></i> <span>Service Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo url_to(array("Orders","Add")); ?>"><i class="fa fa-circle-o"></i> Add New</a></li>
            <li><a href="<?php echo url_to(array("Orders","All")); ?>"><i class="fa fa-circle-o"></i> View All</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>