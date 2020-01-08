<?php require_once __DIR__."/../../config/init.php";
  $user_id = Session::get('user_id');
  $user_detail = new User();
  $user_detail->find($user_id);

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">


  <title>Epub-Manager Admin Dashboard</title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
  <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />


  <!-- PLUGINS CSS STYLE -->
  <link href="../assets/plugins/nprogress/nprogress.css" rel="stylesheet" />



  <!-- No Extra plugin used -->



  <link href="../assets/plugins/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />



  <link href="../assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" />



  <link href="../assets/plugins/toastr/toastr.min.css" rel="stylesheet" />



  <!-- SLEEK CSS 123-->

  <link id="" rel="stylesheet" href="../assets/css/sleek.css" />

  <!-- FAVICON -->
  <link href="../assets/img/favicon.png" rel="shortcut icon" />



  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="../assets/plugins/nprogress/nprogress.js"></script>
</head>


<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">

  <script>
    NProgress.configure({ showSpinner: false });
    NProgress.start();
  </script>


  <div id="toaster"></div>


  <div class="wrapper">
    <!-- Github Link -->
   

            <!--
          ====================================
          ——— LEFT SIDEBAR WITH FOOTER
          =====================================
        -->

        <?php require_once __DIR__."/sidebar.php"; ?>


    <div class="page-wrapper">

      <!-- Header -->
      <header class="main-header " id="header">
            <nav class="navbar navbar-static-top navbar-expand-lg" style="padding-right: 0px;">
              <!-- Sidebar toggle button -->
              <button id="sidebar-toggler" class="sidebar-toggle">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <!-- search form -->
              <div class="search-form d-none d-lg-inline-block">
                <div class="input-group">
                  <button type="button" name="search" id="search-btn" class="btn btn-flat">
                    <i class="mdi mdi-magnify"></i>
                  </button>
                  <input type="text" name="query" id="search-input" class="form-control" placeholder="'button', 'chart' etc."
                    autofocus autocomplete="off" />
                </div>
                <div id="search-results-container">
                  <ul id="search-results"></ul>
                </div>
              </div>

              <div class="navbar-right ">
                <ul class="nav navbar-nav">
                  <li class="dropdown notifications-menu">
                    <button class="dropdown-toggle" data-toggle="dropdown">
                      <i class="mdi mdi-bell-outline"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <?php
                        $read_notification = new Notification();
                        $read_notification->Where("user_id","$user_id")->Where("notification_read","0");
                        $notifications = $read_notification->get();
                      ?>
                      <li class="dropdown-header">You have <?php echo count($notifications);?> Notifications</li>
                      <?php 
                         $no_of_notification = 0;
                         foreach ($notifications as $notification) {
                          $no_of_notification++;
                          if ($no_of_notification > 10) {
                            break;
                          }
                         ?>
                           <li>
                             <a href="../views/book-actions.php?id=<?php echo $notification['book_id']; ?>&n_id=<?php echo $notification['id'];?>">
                               <i class="mdi mdi-message-plus"></i> <?php
                                  echo $notification['title'] ; ?>
                               <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> <?php echo $notification['notify_at']; ?></span>
                             </a>
                           </li>
                         <?php  
                         }
                         ?>
                      <li class="dropdown-footer">
                        <a class="text-center" href="../views/all-notification.php"> View All </a>
                      </li>
                    </ul>
                  </li>
                  <!-- <li class="right-sidebar-in right-sidebar-2-menu">
                    <i class="mdi mdi-settings"></i>
                  </li> -->
                  <!-- User Account -->
                  <li class="dropdown user-menu">
                    <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                      <img src="../assets/img/user/user.png" class="user-image" alt="User Image" />
                      <span class="d-none d-lg-inline-block"><?php echo $user_detail->firstname; ?></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                      <!-- User image -->
                      <li class="dropdown-header">
                        <img src="../assets/img/user/user.png" class="img-circle" alt="User Image" />
                        <div class="d-inline-block">
                          <?php echo $user_detail->firstname; ?> <small class="pt-1"><?php echo $user_detail->email;?></small>
                        </div>
                      </li>

                      <li>
                        <a href="user-profile.html" class="d-none">
                          <i class="mdi mdi-account"></i> My Profile
                        </a>
                      </li>
                      <li class="dropdown-footer">
                        <a href="<?php echo $base_url; ?>logout.php"> <i class="mdi mdi-logout"></i> Log Out </a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </div>
            </nav>
            

          </header>
