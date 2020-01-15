<?php
require_once __DIR__ . "/layouts/header.php";

if($_POST){
  $db = $_POST['db'];
  $date_start = date("Y-m-d",strtotime($_POST['date_start']));
  $date_end = date("Y-m-d",strtotime($_POST['date_end']));

  if($db == "uk"){
    $api_url = "https://ampdbuk.viralwebbs.com/api/epub_books.php";
  }elseif($db == "usa"){
    $api_url = "https://ampdbusa.viralwebbs.com/api/epub_books.php";
  }elseif($db == "uae"){
    $api_url = "https://ampdbuae.viralwebbs.com/api/epub_books.php";
  }
  $api_url .= "?date_start=$date_start&date_end=$date_end";

  $api_resp = file_get_contents($api_url);

  $data = json_decode($api_resp,true);
  $error = $data['error'];
  if(!$error){
    $books = $data['data'];
  }
}
?>

<div class="content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <h1>Import Books</h1>

        </div>

        <div class="row">
          <div class="col-12">
            <div class="card card-default">
              <div class="card-header card-header-border-bottom">
                <h2>Import Books from AM Database</h2>
              </div>
              <div class="card-body">

                <form class="form-inline" method="post" action="">
                  <label class="sr-only" for="inlineFormInputName2">DB</label>
                  <select class="form-control mb-2 mr-sm-2" name="db">
                    <option value="uk">UK DB</option>
                    <option value="usa">USA DB</option>
                    <option value="uae">UAE DB</option>
                  </select>

                  <label class="sr-only" for="inlineFormInputGroupUsername2">Publication Start</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Publication Start</div>
                    </div>
                    <input type="date" name="date_start" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                  </div>

                  <label class="sr-only" for="inlineFormInputGroupUsername2">Publication End</label>
                  <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                      <div class="input-group-text">Publication End</div>
                    </div>
                    <input type="date" name="date_end" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Username">
                  </div>

                  <button type="submit" class="btn btn-primary mb-2">Import</button>
                </form>

                <?php
                if($_POST){
                  ?>
                <div class="pt-5 mt-4 border-top w-100">

                  <form action="<?php echo $base_url; ?>actions/process_books_import.php" method="post">
                    <p class="text-primary mb-4">Process Imported Books.</p>
                    <?php
                    if($error){
                      echo "<p class='text-center'>Error while fetching Books or no Book found!</p>";
                    }else{
                      ?>
                      <input type="hidden" value="<?php echo $db; ?>" name="db" />
                      <input type="hidden" value='<?php echo base64_encode(serialize($books)); ?>' name="books" />
                      <button type="submit" class="btn btn-primary ml-2">Process Books</button>
                      <?php
                    }
                    ?>

                  </form>

                  <div class="row pt-5">
                    <div class="col-12">

                        <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Book Title</th>
                                    <th>ISBN</th>
                                    <th>Penname</th>
                                    <th>Book Type</th>
                                    <th>Publication Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              if(!$error){
                                foreach($books as $book){
                                  ?>
                                  <tr>
                                    <td><?php echo $book['book_title']; ?></td>
                                    <td><?php echo $book['isbn']; ?></td>
                                    <td><?php echo $book['penname']; ?></td>
                                    <td><?php echo $book['book_type']; ?></td>
                                    <td><?php echo $book['date_publication']; ?></td>

                                    <td>
                                      <?php
                                       $book_ch = new Book();
                                       $book_ch = $book_ch->where("isbn",$book['isbn'])->first();
                                       if($book_ch){
                                         echo "<span class='badge badge-danger'>Already Exists</span>";
                                       }else{
                                         echo "<span class='badge badge-success'>New Book</span>";
                                       }
                                      ?>
                                    </td>
                                  </tr>
                                  <?php
                                }
                              }else{
                                ?>
                                <tr>
                                  <td colspan="5"><p class="text-center">No Book Found or Error while fetching Books Data.</p></td>
                                </tr>
                                <?php
                              }
                              ?>
                            </tbody>
                          </table>

                    </div>
                  </div>

                </div>
                <?php
              }
              ?>


              </div>
            </div>
          </div>

        </div>


    </div>




    <div class="right-sidebar-2">
        <div class="right-sidebar-container-2">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                <div class="slim-scroll-right-sidebar-2" style="overflow: hidden; width: auto; height: 100%;">

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
                <div class="slimScrollBar" style="background: rgb(153, 153, 153); width: 5px; position: absolute; top: 0px; opacity: 0; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 979px;"></div>
                <div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
            </div>
        </div>

    </div>

</div>

<!-- Edit User Name -->
<div class="modal fade" id="modal-add-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="../actions/update_department.php" method="post">
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit User Name</h5>
                </div>
                <div class="modal-body px-4">

                    <div class="form-group row mb-6">

                        <div class="col-sm-8 col-lg-10">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Edit User Name</label>
                                <input type="text" name="name" id="user_name" required class="form-control" id="formGroupExampleInput" placeholder="Add New User">
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

<script>
    function showEditForm(user_id, user_name) {
        $("#user_id").val(user_id);
        $("#user_name").val(user_name);
        $('#modal-add-edit').modal('show');
    }
</script>
<?php require_once __DIR__ . "/layouts/footer.php" ?>
