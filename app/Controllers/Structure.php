<?php

namespace App\Controllers;

class Structure
{
  public function Topbar(){
    return '
    
                <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                <button class="btn navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav d-flex align-items-center navbar-light ms-auto">
                        <li class="dropdown nav-icon">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-lg-inline-block">
                                    <i data-feather="bell"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-large">
                                <h6 class="py-2 px-4">Notifications</h6>
                                <ul class="list-group rounded-none">
                                    <li class="list-group-item border-0 align-items-start">
                                        <div class="avatar bg-success me-3">
                                            <span class="avatar-content"><i data-feather="shopping-cart"></i></span>
                                        </div>
                                        <div>
                                            <h6 class="text-bold">New Order</h6>
                                            <p class="text-xs">
                                                An order made by Ahmad Saugi for product Samsung Galaxy S69
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="dropdown nav-icon me-2">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="d-lg-inline-block">
                                    <i data-feather="mail"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <div class="avatar me-1">
                                    <img src="../../../assets/images/avatar/avatar-s-1.png" alt="" srcset="">
                                </div>
                                <div class="d-none d-md-block d-lg-inline-block">Hi, Saugi</div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#"><i data-feather="user"></i> Account</a>
                                <a class="dropdown-item active" href="#"><i data-feather="mail"></i> Messages</a>
                                <a class="dropdown-item" href="#"><i data-feather="settings"></i> Settings</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../Home/sing_off.php"><i data-feather="log-out"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
  
    ';
  }

  public function Navbar($active_page){
      
      
      $sub_page='';
      switch ($active_page){
        case 'Cocina': $sub_page = 'Cocina'; break;
        case 'Sistemas': $sub_page = 'Sistemas'; break;
        case 'Mantenimiento': $sub_page = 'Mantenimiento'; break;
        case 'RR.HH': $sub_page = 'RR.HH'; break;
      }
      
      return  '
              <div class="sidebar-menu">
          <ul class="menu">
            <li class="sidebar-title">Main Menu</li>

            <li class="sidebar-item '. ($active_page == 'Dashboard' ? 'active' : '') .'">
              <a href="Dashboard.php" class="sidebar-link">
                <i data-feather="home" width="20"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="sidebar-title">Areas &amp; Miembros</li>

            <li class="sidebar-item '. ($active_page == $sub_page ? 'active' : '') .' has-sub">
              <a href="#" class="sidebar-link">
                <i data-feather="map" width="20"></i>
                <span>Areas</span>
              </a>

              <ul class="submenu '. ($active_page == $sub_page ? 'active' : '') .'">
                <li>
                  <a href="Kitchen.php">Cocina
                  <i data-feather="sliders" width="20"></i></a>
                </li>

                <li>
                  <a href="Systems.php">Sistemas
                  <i data-feather="wifi" width="20"></i></a>
                  
                </li>

                <li>
                  <a href="Maintenance.php">Mantenimiento
                  <i data-feather="tool" width="20"></i></a>
                  
                </li>

                <li>
                  <a href="HR.php">R.H
                  <i data-feather="user-check" width="20"></i></a>
                </li>
              </ul>
            </li>

            <li class="sidebar-item '. ($active_page == 'Personal' ? 'active' : '') .'">
              <a href="Staff.php" class="sidebar-link">
                <i data-feather="users" width="20"></i>
                <span>Personal</span>
              </a>
            </li>
            <li class="sidebar-title">Informes</li>

            <li class="sidebar-item '. ($active_page == 'Reportes' ? 'active' : '') .'">
              <a href="Reports.php" class="sidebar-link">
                <i data-feather="file-text" width="20"></i>
                <span>Reportes</span>
              </a>
            </li>
          </ul>
        </div>
      
      ';
  }

  public function PagesTitle($title){
    return '
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">'.$title.'</li>
                    </ol>
                </nav>
            </div>
          ';
  }
}
?>