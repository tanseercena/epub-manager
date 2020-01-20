<?php
require_once __DIR__ . "/layouts/header.php";
if ($_GET["id"]) {
   $action = new Action(0,0,0);
   $book_id = $_GET['id'];
   $actions = $action->where("book_id",$book_id)->orderBy('created_at','DESC')->get();
   $book = new Book();
   $book->find($book_id);
}


?>


<div class="content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <h1>Book Actions</h1>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Recent Order Table -->
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">

                        <h2><?php echo $book->book_title.' ('.$book->isbn.') '."By ". $book->penname; ?></h2>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <div class="container py-2">

                            <!-- timeline item 1 -->
                            <?php
                                $counter = 1;
                                foreach($actions as $action){
                                $border_class = "border-light";
                                $badge_class = "bg-light";
                                $text_class = "text-light";
                                if ($action['status_id'] == 1 || $action['status_id'] == 13 || $action['status_id'] == 6) {
                                    $border_class = "border-primary";
                                    $badge_class = "bg-primary";
                                    $text_class  = "text-primary";
                                }
                                if ($action['status_id'] == 2 || $action['status_id'] == 8 || $action['status_id'] == 10) {
                                    $border_class = "border-danger";
                                    $badge_class = "bg-danger";
                                    $text_class  = "text-danger";
                                }
                                if ($action['status_id'] == 3 || $action['status_id'] == 7 ){
                                    $border_class = "border-warning";
                                    $badge_class = "bg-warning";
                                    $text_class  = "text-warning";
                                }
                                if ($action['status_id'] == 5 || $action['status_id'] == 11 || $action['status_id'] == 9){
                                    $border_class = "border-success";
                                    $badge_class = "bg-success";
                                    $text_class  = "text-success";
                                }
                                if ($action['status_id'] == 12 || $action['status_id'] == 4)  {
                                    $border_class = "border-info";
                                    $badge_class = "bg-info";
                                    $text_class  = "text-info";
                                }

                                $file_actions = [9,8,7,4,11];
                            ?>
                            <div class="row no-gutters" >
                                <?php
                                    if($counter % 2 != 0){
                                        ?>
                                        <div class="col-sm"> <!--spacer--> </div>
                                        <!-- timeline item 1 center dot -->
                                        <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                                            <div class="row h-50">
                                                <div class="col">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                            <h5 class="m-2">
                                                <span class="badge badge-pill <?php echo $badge_class; ?> border">&nbsp;</span>
                                            </h5>
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                ?>

                                <!-- timeline item 1 event content -->
                                <div class="col-sm py-2" >
                                    <div class="card <?php echo $border_class; ?> shadow" id="action-<?php echo $action['id']; ?>">
                                        <div class="card-body">
                                            <div class="float-right <?php echo $text_class; ?> small"><?php echo $action['created_at'];?></div>
                                            <?php
                                                  $status_id = $action['status_id'];
                                                  $status = new Status();
                                                  $status->find($status_id);
                                            ?>
                                            <h4 class="card-title <?php echo $text_class; ?>"><?php echo $status->title; ?></h4>
                                            <?php
                                                  $user_id = $action['user_id'];
                                                  $user = new User();
                                                  $user->find($user_id);
                                            ?>
                                            <p class="card-text">Action By:
                                                <strong>
                                                 <?php echo $user->firstname.' '.$user->lastname; ?>

                                                 </strong>
                                                 &nbsp;&nbsp;
                                                 Action To:
                                                 <strong>
                                                 <?php
                                                 $department = new Department();
                                                 $department->find($action['department_id']);
                                                 echo $department->name;
                                                 ?>
                                                 </strong>
                                             </p>
                                             <strong>Notes: </strong>
                                            <p><?php echo $action['notes']; ?></p>
                                            <?php
                                            if(in_array($action['status_id'],$file_actions)){
                                              $file = new BookFile();
                                              $action_file = $file->where("action_id",$action['id'])->first();
                                              if($action_file){
                                                $action_file__ = $action_file['filename'];
                                                ?>
                                                <p>
                                                  <br />
                                                  <strong>File: </strong>
                                                  <?php
                                                    if($action['status_id'] != 4){  // If not HS file and epub file
                                                      ?>
                                                      <a href="<?php echo $base_url; ?>views/epub_viewer.php?file_id=<?php echo $action_file['id']; ?>" target="_blank">View File</a> |
                                                      <?php
                                                    }
                                                  ?>
                                                  <a href="<?php echo $base_url; ?>assets/epub_files/<?php echo $book->isbn; ?>/<?php echo $action_file__; ?>" >Download File</a>
                                                </p>
                                                <?php
                                              }
                                            }

                                            if($action['epubcheck_id']){
                                              ?>
                                              <p>
                                                <br />
                                                <strong>Logs: </strong>
                                                <a href="javascript:void(0);" onclick="showValidationLogs(<?php echo $action['epubcheck_id']; ?>)">See Logs</a>
                                              </p>
                                              <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    if($counter % 2 == 0){
                                        ?>
                                        <div class="col-sm-1 text-center flex-column d-none d-sm-flex">
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                            <h5 class="m-2">
                                                <span class="badge badge-pill <?php echo $badge_class; ?> ">&nbsp;</span>
                                            </h5>
                                            <div class="row h-50">
                                                <div class="col border-right">&nbsp;</div>
                                                <div class="col">&nbsp;</div>
                                            </div>
                                        </div>
                                        <div class="col-sm"> <!--spacer--> </div>
                                        <?php
                                    }
                                ?>
                            </div>
                            <?php
                                $counter++;
                                }
                            ?>
                            <!--/row-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<div class="modal fade" id="modal-logs" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
                <input type="hidden" name="department_id" id="department_id">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Validation Logs</h5>
                </div>
                <div class="modal-body px-4">

                    <div class="mb-6" id="logs_cont">
                    </div>


                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Cancel</button>

                </div>
        </div>
    </div>
</div>

<script>
  function showValidationLogs(check_id){
    $.ajax({
      url: "<?php echo $base_url; ?>actions/ajax/epub_logs.php",
      type: "POST",
      data: {id: check_id},
      success: function(resp){
        $("#logs_cont").html(resp);
      }
    });

    $('#modal-logs').modal('show');
  }
</script>

<?php require_once __DIR__ . "/layouts/footer.php" ?>
