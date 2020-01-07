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

        <!-- <li class="has-sub">
          <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#documentation" aria-expanded="false" aria-controls="documentation">
            <i class="mdi mdi-book-open-page-variant"></i>
            <span class="nav-text">Documentation</span> <b class="caret"></b>
          </a>
          <ul class="collapse" id="documentation" data-parent="#sidebar-menu">
            <div class="sub-menu">



              <li class="section-title">
                Getting Started
              </li>






              <li>
                <a class="sidenav-item-link" href="introduction.html">
                  <span class="nav-text">Introduction</span>

                </a>
              </li>






              <li>
                <a class="sidenav-item-link" href="quick-start.html">
                  <span class="nav-text">Quick Start</span>

                </a>
              </li>






              <li>
                <a class="sidenav-item-link" href="customization.html">
                  <span class="nav-text">Customization</span>

                </a>
              </li>






              <li class="section-title">
                Layouts
              </li>





              <li class="has-sub">
                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#headers" aria-expanded="false" aria-controls="headers">
                  <span class="nav-text">Header Variations</span> <b class="caret"></b>
                </a>
                <ul class="collapse" id="headers">
                  <div class="sub-menu">

                    <li>
                      <a href="header-fixed.html">Header Fixed</a>
                    </li>

                    <li>
                      <a href="header-static.html">Header Static</a>
                    </li>

                    <li>
                      <a href="header-light.html">Header Light</a>
                    </li>

                    <li>
                      <a href="header-dark.html">Header Dark</a>
                    </li>

                  </div>
                </ul>
              </li>




              <li class="has-sub">
                <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#sidebar-navs" aria-expanded="false" aria-controls="sidebar-navs">
                  <span class="nav-text">Sidebar Variations</span> <b class="caret"></b>
                </a>
                <ul class="collapse" id="sidebar-navs">
                  <div class="sub-menu">

                    <li>
                      <a href="sidebar-fixed-default.html">Sidebar Fixed Default</a>
                    </li>

                    <li>
                      <a href="sidebar-fixed-minified.html">Sidebar Fixed Minified</a>
                    </li>

                    <li>
                      <a href="sidebar-fixed-offcanvas.html">Sidebar Fixed Offcanvas</a>
                    </li>

                    <li>
                      <a href="sidebar-static-default.html">Sidebar Static Default</a>
                    </li>

                    <li>
                      <a href="sidebar-static-minified.html">Sidebar Static Minified</a>
                    </li>

                    <li>
                      <a href="sidebar-static-offcanvas.html">Sidebar Static Offcanvas</a>
                    </li>

                    <li>
                      <a href="sidebar-with-footer.html">Sidebar With Footer</a>
                    </li>

                    <li>
                      <a href="sidebar-without-footer.html">Sidebar Without Footer</a>
                    </li>

                    <li>
                      <a href="right-sidebar.html">Right Sidebar</a>
                    </li>

                  </div>
                </ul>
              </li>





              <li>
                <a class="sidenav-item-link" href="rtl.html">
                  <span class="nav-text">RTL Direction</span>

                </a>
              </li>




            </div>
          </ul>
        </li> -->



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