<aside class="left-sidebar bg-sidebar">
  <div id="sidebar" class="sidebar sidebar-with-footer">
    <!-- Aplication Brand -->
    <div class="app-brand">
      <a href="/index.html">
        <svg class="brand-icon" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid" width="30" height="33" viewBox="0 0 30 33">
          <g fill="none" fill-rule="evenodd">
            <path class="logo-fill-blue" fill="#7DBCFF" d="M0 4v25l8 4V0zM22 4v25l8 4V0z" />
            <path class="logo-fill-white" fill="#FFF" d="M11 4v25l8 4V0z" />
          </g>
        </svg>
        <span class="brand-name">Epub Manager</span>
      </a>
    </div>
    <!-- begin sidebar scrollbar -->
    <div class="sidebar-scrollbar">

      <!-- sidebar menu -->
      <ul class="nav sidebar-inner" id="sidebar-menu">



        <li class="has-sub active expand">
          <a class="sidenav-item-link" href="./dashboard.php">
            <i class="mdi mdi-view-dashboard-outline"></i>
            <span class="nav-text">Dashboard</span>
            <!-- <b class="caret"></b> -->
          </a>
        </li>
        <li class="has-sub">
          <a class="sidenav-item-link" href="./books.php">
            <i class="mdi mdi-library-books"></i>
            <span class="nav-text">Books</span>
          </a>
        </li>

        <?php 
          $user = new User();
          $user_id = Session::get("user_id");
          $user->find($user_id);
          if($user->admin == 1){

          
        ?>
        <li class="has-sub">
          <a class="sidenav-item-link" href="./manage-books.php">
            <i class="mdi mdi-pencil-box-multiple"></i>
            <span class="nav-text">Manage Books</span>
          </a>

        </li>
        <li class="has-sub">
          <a class="sidenav-item-link" href="./manage-action.php">
            <i class="mdi  mdi-plus-circle"></i>
            <span class="nav-text">Manage Actions</span>
          </a>
        </li>
        <li class="has-sub">
          <a class="sidenav-item-link" href="./manage-status.php">
            <i class=" mdi mdi-account-alert"></i>
            <span class="nav-text">Manage Status</span> 
          </a>
        </li>
        <li class="has-sub">
          <a class="sidenav-item-link" href="./manage-users.php">
            <i class="mdi mdi-account-multiple-plus"></i>
            <span class="nav-text">Manage Users</span> 
          </a>
        </li>
        <li class="has-sub">
          <a class="sidenav-item-link" href="./manage-department.php">
            <i class="mdi mdi-office"></i>
            <span class="nav-text">Manage Departments</span> 
          </a>
        </li>
        <li class="has-sub">
          <a class="sidenav-item-link" href="#">
            <i class="mdi mdi-run"></i>
            <span class="nav-text">User Actvities</span>
          </a>
        </li>

        <li class="has-sub">
          <a class="sidenav-item-link" href="./manage-excel.php">
            <i class="mdi mdi-run"></i>
            <span class="nav-text">Excel Book Import</span>
          </a>
        </li>


        <?php 
          }
        ?>
      </ul>

    </div>

    <div class="sidebar-footer">
      <hr class="separator mb-0" />
      <div class="sidebar-footer-content">
        <h6 class="text-uppercase">
          Cpu Uses <span class="float-right">40%</span>
        </h6>
        <div class="progress progress-xs">
          <div class="progress-bar active" style="width: 40%;" role="progressbar"></div>
        </div>
        <h6 class="text-uppercase">
          Memory Uses <span class="float-right">65%</span>
        </h6>
        <div class="progress progress-xs">
          <div class="progress-bar progress-bar-warning" style="width: 65%;" role="progressbar"></div>
        </div>
      </div>
    </div>
  </div>
</aside>