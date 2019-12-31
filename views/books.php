<?php
require_once __DIR__ . "/layouts/header.php";
?>


<div class="content-wrapper">
        <div class="content">
          <div class="breadcrumb-wrapper breadcrumb-contacts">
  <div>
    <h1>Books</h1>
    
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
              <a href="index.html">
                <span class="mdi mdi-home"></span>                
              </a>
            </li>
            <li class="breadcrumb-item">
              App
            </li>
            <li class="breadcrumb-item" aria-current="page">books</li>
          </ol>
        </nav>

  </div>
  <div>
    <form class="form-inline" action="" method="POST">
        <div class="form-group">
           <input type="text" name="penname_title" class="form-control mx-3" placeholder="Book/Author Name: ">
        
           <input type="date" name="s_date" class="form-control mx-3" placeholder="Date Publication From: ">
        
           <input type="date" name="e_date" class="form-control mx-3" placeholder="Date Publication To: ">
        </div>
        
        <button type="submit" class="btn btn-primary"> Filter
        </button>
        
    </form>
    
  </div>
</div>

<div class="row">
    <?php
    $sql_query = new Book();

    if ($_POST) {
        if (!empty($_POST["penname_title"])) {
            $title = $_POST["penname_title"];
            $sql_query->orWhere("book_title","%$title%"," LIKE ")->orWhere("penname","%$title%"," LIKE ");
        } 
        if (!empty($_POST["s_date"]) && !empty($_POST["e_date"])) {
            $s_date = date($_POST["s_date"]);
            $e_date = date($_POST["e_date"]);
            $sql_query->where("publication_date","$s_date"," >= ")->where("publication_date","$e_date"," <= ");
        } 
    }
    else{
        $s_date = date("Y-m-01");
        $e_date = date("Y-m-t");
        $sql_query->where("publication_date","$s_date"," >= ")->where("publication_date","$e_date"," <= ");
        // echo $sql_query->getSql();
    }
    $books = $sql_query->get();
      
      foreach ($books as $book) {
    ?>
  <div class="col-lg-6 col-xl-4">
    <div class="card card-default p-4">
      <a href="javascript:0" class="media text-secondary" data-toggle="modal" data-target="#modal-book-<?php echo $book['id']; ?>">
        <img src="assets/img/user/u-xl-1.jpg" class="mr-3 img-fluid rounded" alt="Avatar Image">
        <div class="media-body">
          <h5 class="mt-0 mb-2 text-dark"><?php echo $book["book_title"]; ?></h5>
          <ul class="list-unstyled">
            <li class="d-flex mb-1">
              <i class="mdi mdi-map mr-1"></i>
              <span><?php echo $book["penname"]; ?></span>
            </li>
            <li class="d-flex mb-1">
              <i class="mdi mdi-email mr-1"></i>
              <span><?php echo $book["isbn"]; ?></span>
            </li>
            <li class="d-flex mb-1">
              <i class="mdi mdi-phone mr-1"></i>
              <span><?php echo $book["publication_date"]; ?></span>
            </li>
          </ul>

        </div>
      </a>

    </div>
  </div>
  
 <!-- Modal -->
  <div class="modal fade" id="modal-book-<?php echo $book['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header justify-content-end border-bottom-0">
        <button type="button" class="btn-edit-icon" data-dismiss="modal" aria-label="Close">
          <i class="mdi mdi-pencil"></i>
        </button>
        <div class="dropdown">
          <button class="btn-dots-icon" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="mdi mdi-dots-vertical"></i>
          </button>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </div>
        <button type="button" class="btn-close-icon" data-dismiss="modal" aria-label="Close">
          <i class="mdi mdi-close"></i>
        </button>
      </div>
      <div class="modal-body pt-0">
        <div class="row no-gutters">
          <div class="col-md-6">
            <div class="profile-content-left px-4">
              <div class="card text-center widget-profile px-0 border-0">
                <div class="card-img mx-auto rounded-circle">
                  <img src="assets/img/user/u6.jpg" alt="user image">
                </div>
                <div class="card-body">
                  <h4 class="py-2 text-dark"><?php echo $book['book_title']; ?></h4>
                  <p><?php echo $book['penname']; ?></p>
                  <a class="btn btn-primary btn-pill btn-lg my-4" href="#">Follow</a>
                </div>
              </div>
              <div class="d-flex justify-content-between ">
                <div class="text-center pb-4">
                  <h6 class="text-dark pb-2">1503</h6>
                  <p>Friends</p>
                </div>
                <div class="text-center pb-4">
                  <h6 class="text-dark pb-2">2905</h6>
                  <p>Followers</p>
                </div>
                <div class="text-center pb-4">
                  <h6 class="text-dark pb-2">1200</h6>
                  <p>Following</p>
                </div>
              </div>

            </div>
          </div>
          <div class="col-md-6">
            <div class="contact-info px-4">
              <h4 class="text-dark mb-1">Contact Details</h4>
              <p class="text-dark font-weight-medium pt-4 mb-2">Email address</p>
              <p>Albrecht.straub@gmail.com</p>
              <p class="text-dark font-weight-medium pt-4 mb-2">Phone Number</p>
              <p>+99 9539 2641 31</p>
              <p class="text-dark font-weight-medium pt-4 mb-2">Birthday</p>
              <p>Nov 15, 1990</p>
              <p class="text-dark font-weight-medium pt-4 mb-2">Event</p>
              <p>Lorem, ipsum dolor</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


    <?php
         }
    ?>
</div>





<!-- Add Contact Button  -->
<div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <form >
        <div class="modal-header px-4">
          <h5 class="modal-title" id="exampleModalCenterTitle">Create New Contact</h5>
        </div>
        <div class="modal-body px-4">

          <div class="form-group row mb-6">
            <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label">User Image</label>
            <div class="col-sm-8 col-lg-10">
              <div class="custom-file mb-1">
                <input type="file" class="custom-file-input" id="coverImage" required>
                <label class="custom-file-label" for="coverImage">Choose file...</label>
                <div class="invalid-feedback">Example invalid custom file feedback</div>
              </div>
            </div>
          </div>

          <div class="row mb-2">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="firstName">First name</label>
                <input type="text" class="form-control" id="firstName" value="Albrecht">
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group">
                <label for="lastName">Last name</label>
                <input type="text" class="form-control" id="lastName" value="Straub">
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group mb-4">
                <label for="userName">User name</label>
                <input type="text" class="form-control" id="userName" value="Doe">
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group mb-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" value="albrecht.straub@gmail.com">
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group mb-4">
                <label for="Birthday">Birthday</label>
                <input type="text" class="form-control" id="Birthday" value="01-10-1993">
              </div>
            </div>

            <div class="col-lg-6">
              <div class="form-group mb-4">
                <label for="event">Event</label>
                <input type="text" class="form-control" id="event" value="Some value for event">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer px-4">
          <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary btn-pill">Save Contact</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

        

        <div class="right-sidebar-2">
    <div class="right-sidebar-container-2">
      <div class="slim-scroll-right-sidebar-2">

      <div class="right-sidebar-2-header">
        <h2>Layout Settings</h2>
        <p>User Interface Settings</p>
        <div class="btn-close-right-sidebar-2">
          <i class="mdi mdi-window-close"></i>
        </div>
      </div>

      <div class="right-sidebar-2-body">
        <span class="right-sidebar-2-subtitle">Header Layout</span>
        <div class="no-col-space">
          <a href="javascript:void(0);" class="btn-right-sidebar-2 header-fixed-to btn-right-sidebar-2-active">Fixed</a>
          <a href="javascript:void(0);" class="btn-right-sidebar-2 header-static-to">Static</a>
        </div>

        <span class="right-sidebar-2-subtitle">Sidebar Layout</span>
        <div class="no-col-space">
          <select class="right-sidebar-2-select" id="sidebar-option-select">
            <option value="sidebar-fixed">Fixed Default</option>
            <option value="sidebar-fixed-minified">Fixed Minified</option>
            <option value="sidebar-fixed-offcanvas">Fixed Offcanvas</option>
            <option value="sidebar-static">Static Default</option>
            <option value="sidebar-static-minified">Static Minified</option>
            <option value="sidebar-static-offcanvas">Static Offcanvas</option>
          </select>
        </div>

        <span class="right-sidebar-2-subtitle">Header Background</span>
        <div class="no-col-space">
          <a href="javascript:void(0);" class="btn-right-sidebar-2 btn-right-sidebar-2-active header-light-to">Light</a>
          <a href="javascript:void(0);" class="btn-right-sidebar-2 header-dark-to">Dark</a>
        </div>

        <span class="right-sidebar-2-subtitle">Navigation Background</span>
        <div class="no-col-space">
          <a href="javascript:void(0);" class="btn-right-sidebar-2 btn-right-sidebar-2-active sidebar-dark-to">Dark</a>
          <a href="javascript:void(0);" class="btn-right-sidebar-2 sidebar-light-to">Light</a>
        </div>

        <span class="right-sidebar-2-subtitle">Direction</span>
        <div class="no-col-space">
          <a href="javascript:void(0);" class="btn-right-sidebar-2 btn-right-sidebar-2-active ltr-to">LTR</a>
          <a href="javascript:void(0);" class="btn-right-sidebar-2 rtl-to">RTL</a>
        </div>

        <div class="d-flex justify-content-center" style="padding-top: 30px">
          <div id="reset-options" style="width: auto; cursor: pointer" class="btn-right-sidebar-2 btn-reset">Reset
            Settings</div>
        </div>

      </div>

    </div>
  </div>

</div>

      </div>



<?php require_once __DIR__ . "/layouts/footer.php" ?>