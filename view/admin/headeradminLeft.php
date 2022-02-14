<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?controller=admin&action=dashboardadmin" >
    <img style="width: 60px; height:60px; border-radius: 100px" src="./img/logotlu.jpg" alt="logo">
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item  <?php 
        if(!empty($_GET))
        if($_GET['action'] == 'dashboardadmin' ){echo 'active';}
        
    ?>">
    <a class="nav-link" href="?controller=admin&action=dashboardadmin">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Bảng điều khiển</span></a>
  </li>


  <hr class="sidebar-divider">
  <!-- Nav Item - Tables -->
  <li class="nav-item  <?php  if(!empty($_GET)) if($_GET['action'] == 'danhsachgiangvien'){echo ' active';}?>">
    <a class="nav-link" href="?controller=admin&action=danhsachgiangvien">
      <i class="fas fa-fw fa-table"></i>
      <span>Danh sách giảng viên</span></a>
  </li>
  <hr class="sidebar-divider">
  <li class="nav-item <?php  if(!empty($_GET)) if($_GET['action'] == 'danhsachnhanvien'){echo ' active';}?>">
    <a class="nav-link" href="?controller=admin&action=danhsachnhanvien">
      <i class="fas fa-fw fa-table"></i>
      <span>Danh sách nhân viên</span></a>
  </li>
  <hr class="sidebar-divider">
  <li class="nav-item  <?php  if(!empty($_GET)) if($_GET['action'] == 'danhsachsinhvien'){echo ' active';}?>">
    <a class="nav-link" href="?controller=admin&action=danhsachsinhvien">
      <i class="fas fa-fw fa-table"></i>
      <span>Danh sách sinh viên</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>