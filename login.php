<?php
require_once "config/init.php";
$user_id = Session::get("user_id");
if(!empty($user_id)){
  header("Location: ".$base_url."views/dashboard.php");
  exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Epub Tracker by Viralwebbs">


  <title>Login - <?php echo $site_name; ?></title>

  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
  <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />


  <!-- PLUGINS CSS STYLE -->
  <link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet" />



  <!-- SLEEK CSS -->
  <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />

  <!-- FAVICON -->
  <link href="<?php echo $base_url ?>assets/img/logo.png" rel="shortcut icon" />



  <!--
    HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries
  -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="assets/plugins/nprogress/nprogress.js"></script>
</head>

</head>
  <body class="" id="body">
      <div class="container d-flex flex-column justify-content-between vh-100">
      <div class="row justify-content-center mt-5">
        <div class="col-xl-5 col-lg-6 col-md-10">
          <div class="card">
            <div class="card-header bg-primary">
              <div class="app-brand">
                <a href="<?php echo $base_url; ?>">
                  <img src="<?php echo $logo; ?>" style="width: 50px;" >
                  <span class="brand-name"><?php echo $site_name; ?></span>
                </a>
              </div>
            </div>
            <div class="card-body p-5">

              <h4 class="text-dark mb-5">Sign In</h4>
              <form action="actions/user_login.php" method="post">
                <div class="row">
                  <div class="col-12 mb-2">
                    <p class="text-danger text-center">
                      <?php
                      if(Session::has('error'))
                      {
                           echo Session::flash('error');
                      }
                      ?>
                    </p>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-md-12 mb-4">
                    <input type="email" name="email" class="form-control input-lg" id="email" aria-describedby="emailHelp" placeholder="Username">
                  </div>
                  <div class="form-group col-md-12 ">
                    <input type="password" name="password" class="form-control input-lg" id="password" placeholder="Password">
                  </div>
                  <div class="col-md-12">
                    <!-- <div class="d-flex my-2 justify-content-between">
                      <div class="d-inline-block mr-3">
                        <label class="control control-checkbox">Remember me
                          <input type="checkbox" />
                          <div class="control-indicator"></div>
                        </label>

                      </div>
                      <p><a class="text-blue" href="#">Forgot Your Password?</a></p>
                    </div> -->
                    <button type="submit" class="btn btn-lg btn-primary btn-block mb-4">Sign In</button>
                    <!-- <p>Don't have an account yet ?
                      <a class="text-blue" href="register.php">Sign Up</a>
                    </p> -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="copyright pl-0">
        <p class="text-center">&copy; <?php echo date("Y"); ?> Copyright Epub Tracker by
          <a class="text-primary" href="http://www.viralwebbs.com/" target="_blank">Viral Webbs</a>.
        </p>
      </div>
    </div>

</body>
</html>
