<?php
require_once __DIR__ . "/layouts/header.php";

$logged_user_id = Session::get("user_id");
$department_id = Session::get("department_id");
$action = new Action(0,0,0);
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

</div>

<div class="row">
  <div class="col-12">
    <div class="card card-default">
      <div class="card-header card-header-border-bottom">
        <h2>Filter Books</h2>
      </div>
      <div class="card-body">

        <form class="form-inline" action="" method="POST">
              <?php
                if($department_id == 1 || $logged_user_id == 1){
                  ?>
                  <select class="form-control mb-2 mr-sm-2" name="user_id">
                    <option value="">Assigned User</option>
                    <?php
                    $user = new User();
                    $all_users = $user->where("department_id",1)->get(); // Only Dev Team
                    foreach($all_users as $usr){
                      echo '<option value="'.$usr['id'].'">'.$usr['firstname'].' '.$usr['lastname'].'</option>';
                    }
                    ?>
                  </select>
                  <?php
                }
              ?>

              <select class="form-control mb-2 mr-sm-2" name="status">
                <option value="">Select Status</option>
                <?php
                $status = new Status();
                $all_statuses = $status->all();
                foreach($all_statuses as $sts){
                  echo '<option value="'.$sts['id'].'">'.$sts['title'].'</option>';
                }
                ?>
              </select>

              <select class="form-control mb-2 mr-sm-2" name="book_type">
                <option value="">Book Type</option>
                <option value="text">Text</option>
                <option value="indesign">Indesign</option>
              </select>


               <select id="book_origin" name="book_origin"  class="form-control mx-3">
                  <option  value="">Select Origin</option>
                  <option value="uk">UK</option>
                  <option value="usa">USA</option>
                  <option value="uae">UAE</option>
               </select>
               <input type="text" name="penname_title" class="form-control mx-3" placeholder="ISBN/Book/Author Name: ">

               <input type="date" name="s_date" class="form-control mx-3" placeholder="Date Publication From: ">

               <input type="date" name="e_date" class="form-control mx-3" placeholder="Date Publication To: ">


            <button type="submit" class="btn btn-primary"> Filter
            </button>

        </form>

      </div>
    </div>
  </div>

</div>


<div class="row">
    <?php
    $sql_query = new Book();

    if ($_POST) {
        if (!empty($_POST["penname_title"])) {
            $title = $_POST["penname_title"];
            $sql_query->orWhere("book_title","%$title%"," LIKE ")
            ->orWhere("penname","%$title%"," LIKE ")
            ->orWhere("isbn","%$title%"," LIKE ");
        }
        if (!empty($_POST["s_date"]) && !empty($_POST["e_date"])) {
            $s_date = date($_POST["s_date"]);
            $e_date = date($_POST["e_date"]);
            $sql_query->where("publication_date","$s_date"," >= ")->where("publication_date","$e_date"," <= ");
        }
        if (!empty($_POST["book_origin"])) {
            $book_origin = $_POST["book_origin"];
            $sql_query->where("book_origin","$book_origin"," = ");
        }
        if (!empty($_POST["status"])) {
            $status_id = $_POST["status"];
            $sql_query->where("status_id",$status_id);
        }
        if (!empty($_POST["book_type"])) {
            $book_type = $_POST["book_type"];
            $sql_query->where("book_type",$book_type);
        }
        if (!empty($_POST["user_id"])) {
            $user_id_filter = $_POST["user_id"];
            $sql_query->where("user_id",$user_id_filter);
        }
    }
    else{
        $s_date = date("Y-m-01");
        $e_date = date("Y-m-t");
        $sql_query->where("publication_date","$s_date"," >= ")->where("publication_date","$e_date"," <= ");
        // echo $sql_query->getSql();
    }
    $books = $sql_query->get();
    ?>
    <div class="col-12">
    Total Books: <strong><?php echo count($books); ?></strong>
    </div>
    <?php
      if (count($books) == 0) {
          echo "<h4 class='text-center text-danger font-weight-bold'>No Book Found</h4>";
      }
      else{
      foreach ($books as $book) {
        $status_id = $book['status_id'];
        $status = new Status();
        $status->find($status_id);

        $text_class = "text-muted";

        if ($book['status_id'] == 1 || $book['status_id'] == 13 || $book['status_id'] == 6) {
            $text_class  = "bg-primary";
        }
        if ($book['status_id'] == 2 || $book['status_id'] == 8 || $book['status_id'] == 10) {
            $text_class  = "bg-danger";
        }
        if ($book['status_id'] == 3 || $book['status_id'] == 7) {
            $text_class  = "bg-warning";
        }
        if ($book['status_id'] == 5 || $book['status_id'] == 11 || $book['status_id'] == 9) {
            $text_class  = "bg-success";
        }
        if ($book['status_id'] == 12 || $book['status_id'] == 4) {
            $text_class  = "bg-info";
        }
    ?>
  <div class="col-lg-6 col-xl-4">
    <div class="card card-default p-4">
      <div class="ribbon <?php if($book['book_origin'] == "usa"){echo "blue";}elseif($book['book_origin'] == "uae"){echo "red";} ?>"><span><?php echo ucfirst($book['book_origin']); ?></span></div>
      <a href="javascript:0" class="media text-secondary" data-toggle="modal" data-target="#modal-book-<?php echo $book['id']; ?>">
        <?php
        if (!empty($book['cover'])) {
          if (strpos($book['cover'], 'https://amp') !== false) {
              ?>
              <img data-src="<?php echo $book["cover"]; ?>" class="mr-3 img-fluid rounded lazy" width="100px" height="100px" alt="Book Cover">
              <?php
          }else{
          ?>
            <img src="<?php echo $base_url; ?>assets/img/book-covers/<?php echo $book["cover"]; ?>" class="mr-3 img-fluid rounded lazy" width="100px" height="100px" alt="Book Cover">
          <?php
          }
        }else{
          ?>
          <img src="<?php echo $base_url; ?>assets/img/book-covers/img-not-found.png" class="mr-3 img-fluid rounded" width="100px" height="100px" alt="Book Cover">
          <?php
        }
        ?>

        <div class="media-body">
          <h5 class="mt-0 mb-2 text-dark"><?php echo $book["book_title"]; ?></h5>
          <ul class="list-unstyled">
            <li class="d-flex mb-1">
              <i class="mdi mdi-account mr-1"></i>
              <span><?php echo $book["penname"]; ?></span>
            </li>
            <li class="d-flex mb-1">
              <i class="mdi mdi-barcode mr-1"></i>
              <span><?php echo $book["isbn"]; ?></span>
            </li>
            <li class="d-flex mb-1">
              <i class="mdi mdi-calendar mr-1"></i>
              <span><?php echo $book["publication_date"]; ?></span>
            </li>
          </ul>
          <span class="badge <?php echo $text_class; ?>"><?php echo $status->title;?></span>
          <span class="badge bg-secondary ml-2"><i class="mdi <?php if($book['book_type'] == "text") {echo "mdi-file-word";}else{echo "mdi-image";} ?> mr-1"></i> <?php echo ucfirst($book['book_type']); ?></span>
        </div>
      </a>

    </div>
  </div>

 <!-- Modal -->
  <div class="modal fade" id="modal-book-<?php echo $book['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="ribbon <?php if($book['book_origin'] == "usa"){echo "blue";}elseif($book['book_origin'] == "uae"){echo "red";} ?>"><span><?php echo ucfirst($book['book_origin']); ?></span></div>
      <div class="modal-header justify-content-end border-bottom-0">

      </div>
      <div class="modal-body pt-0">
        <div class="row no-gutters">
          <div class="col-md-8">
            <div class="profile-content-left px-4">
              <div class="card text-center widget-profile px-0 border-0">
                <div class="card-img mx-auto rounded-circle">
                  <?php
                  if (!empty($book['cover'])) {
                    if (strpos($book['cover'], 'https://amp') !== false) {
                        ?>
                        <img data-src="<?php echo $book["cover"]; ?>" class="lazy" width="100px" height="100px" alt="Book Cover">
                        <?php
                    }else{
                    ?>
                      <img src="<?php echo $base_url; ?>assets/img/book-covers/<?php echo $book["cover"]; ?>" width="100px" height="100px" alt="Book Cover">
                    <?php
                    }
                  }else{
                    ?>
                    <img src="<?php echo $base_url; ?>assets/img/book-covers/img-not-found.png" width="100px" height="100px" alt="Book Cover">
                    <?php
                  }
                  ?>

                </div>
                <div class="card-body">
                  <h4 class="py-2 text-dark"><?php echo $book['book_title']; ?></h4>
                  <p><?php echo $book['penname']; ?></p>
                  <a class="btn btn-primary btn-pill btn-lg my-4" href="#">
                    <?php echo $status->title; ?>
                  </a>
                </div>
              </div>
              <div class="d-flex justify-content-between ">
                <?php


                  $status_id = $book['status_id'];
                  $next_actions = $action->getNextAction($status_id,$department_id);
                  if($next_actions)
                  foreach($next_actions as $action_status_id){
                    $status_obj = new Status();
                    $status_obj->find($action_status_id);

                    $file_required = $action->fileRequired($action_status_id,$department_id);
                    $department_id_to = $action->getToDepartment($action_status_id);
                    $department_id_to = json_encode($department_id_to);

                    $btn_class = "";

                    if ($action_status_id == 1 || $action_status_id == 13 || $action_status_id == 4) {
                        $btn_class  = "btn-primary";
                    }
                    if ($action_status_id == 2 || $action_status_id == 8 || $action_status_id == 10) {
                      $btn_class  = "btn-danger";
                    }
                    if ($action_status_id == 6 || $action_status_id == 3) {
                      $btn_class  = "btn-warning";
                    }
                    if ($action_status_id == 5 || $action_status_id == 9 || $action_status_id == 7 || $action_status_id == 11) {
                      $btn_class  = "btn-success";
                    }
                    if ($action_status_id == 12) {
                      $btn_class  = "btn-info";
                    }

                ?>
                <div class="text-center pb-4">
                  <button class="btn <?php echo $btn_class; ?> mx-1" onclick="showNextActionModel(<?php echo $book['id']; ?>,<?php echo  $action_status_id; ?>,<?php echo $file_required; ?>,'<?php echo $department_id_to; ?>')" ><?php echo $status_obj->title; ?></button>
                </div>

                <?php } ?>

                <div class="text-center pb-4">
                  <a href="book-actions.php?id=<?php echo $book['id']?>" class="btn btn-warning mx-1">View Actions</a>
                </div>
              </div>

            </div>
          </div>
          <div class="col-md-4">
            <div class="contact-info px-4">
              <h4 class="text-dark mb-1">Epub Details</h4>
              <p class="text-dark font-weight-medium pt-4 mb-2">Assigned To</p>
              <?php
                $user_id = $book['user_id'];
                $user = new User();
                $user->find($user_id);

              ?>
              <p><?php echo $user->firstname.' '.$user->lastname; ?></p>
              <?php

              if($logged_user_id == 1){ // if admin
                $users_d = new User();
                $dev_users = $users_d->where("department_id",1)->get();

                ?>
                <select class="form-control" onchange="assignUser(this,<?php echo $book['id']; ?>)">
                  <option value="">Assign</option>
                  <?php
                    foreach($dev_users as $dev_user){
                      ?>
                      <option value="<?php echo $dev_user['id']; ?>"><?php echo $dev_user['firstname'].' '.$dev_user['lastname']; ?></option>
                      <?php
                    }
                  ?>
                </select>
                <?php
              }
              ?>
              <p class="text-dark font-weight-medium pt-4 mb-2">Book Type</p>
              <p><?php echo ucfirst($book['book_type']); ?> </p>
              <p class="text-dark font-weight-medium pt-4 mb-2">Validation Status</p>
              <?php
              $status = new Status();
              $action = new Action(0,0,0,0);
              $last= $action->where("book_id",$book['id'])->orWhere("status_id",8)->orWhere("status_id",9)->orderBy("created_at","DESC")->first();
              $last_statusid = $last['status_id'];
              if(!empty($last_statusid))
              $status->find($last_statusid);
              ?>
               <p><?php  echo $status->title ? $status->title : "N/A"; ?></p>
              <p class="text-dark font-weight-medium pt-4 mb-2">QA Status</p>
              <?php
              $status = new Status();
              $action = new Action(0,0,0,0);
              $last= $action->where("book_id",$book['id'])->orWhere("status_id",10)->orWhere("status_id",11)->orderBy("created_at","DESC")->first();
              $last_statusid = $last['status_id'];
              if(!empty($last_statusid))
              $status->find($last_statusid);
              ?>
              <p><?php  echo $status->title ? $status->title : "N/A"; ?></p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>


    <?php
         }
          }
    ?>

</div>

<!-- Button Model -->
<div class="modal fade" id="button_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="../actions/save_action.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="book_id" id="book_id_action" value="">
            <input type="hidden" name="status_id" id="status_id_action" value="">
            <input type="hidden" name="department_id" id="department_id_to" value="">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Action</h5>
                </div>
                <div class="modal-body px-4">

                  <div class="form-group row mb-6 d-none" id="file_show">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="formGroupExampleInput">File</label>
                            <input type="file" id="action_file" name="file" required class="form-control" placeholder="Add File">
                        </div>
                    </div>
                  </div>

                    <div class="form-group row mb-6">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Notes</label>
                                <textarea class="form-control" name="notes"></textarea>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-pill">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>

      </div>

<script>
function showNextActionModel(book_id,status_id, file_required,department_id){
  console.log("Status -> "+status_id+" => "+file_required);

  $("#book_id_action").val(book_id);
  $("#status_id_action").val(status_id);
  $("#department_id_to").val(department_id);

  if(file_required == 1){
    $("#file_show").removeClass("d-none");
    $("#action_file").removeAttr("disabled");
    // $("#file_show").show();
  }else{
    $("#action_file").attr("disabled","disabled");
  }

  $("#button_model").modal();

}

function assignUser(el,book_id){
  var user = $(el).val();
  if(user != ""){
    if (confirm("Are you sure?") == true) {
      $.ajax({
        url: "<?php echo $base_url; ?>actions/ajax/book_assign.php",
        type: "POST",
        data: {user_id: user, book_id: book_id},
        success: function(resp){
          location.reload();
        }
      });
     }

  }
}
</script>

<?php require_once __DIR__ . "/layouts/footer.php" ?>
