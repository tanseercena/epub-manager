<?php
require_once __DIR__ . "/layouts/header.php";
if ($_GET["id"]) {
   $action = new Action(0,0,0);
   $book_id = $_GET['id'];
   $actions = $action->where("book_id",$book_id)->orderBy('created_at','DESC')->get();
   $book = new Book();
   $book->find($book_id);
}
 
if ($_GET["n_id"]) {
    $notification_id = $_GET["n_id"];
    $read_notification = new Notification();
    $read_notification->find($notification_id);
    $read_notification->update(["notification_read"=>1]);
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
                                $border_class = "";
                                $badge_class = "bg-light";
                                $text_class = "text-muted";
                                if ($action['status_id'] == 1 || $action['status_id'] == 9) {
                                    $border_class = "border-primary";
                                    $badge_class = "bg-primary";
                                    $text_class  = "text-primary";
                                }
                                if ($action['status_id'] == 4 || $action['status_id'] == 7) {
                                    $border_class = "border-danger";
                                    $badge_class = "bg-danger";
                                    $text_class  = "text-danger";
                                }
                                if ($action['status_id'] == 3 || $action['status_id'] == 6) {
                                    $border_class = "border-warning";
                                    $badge_class = "bg-warning";
                                    $text_class  = "text-warning";
                                }
                                if ($action['status_id'] == 5 || $action['status_id'] == 8) {
                                    $border_class = "border-success";
                                    $badge_class = "bg-success";
                                    $text_class  = "text-success";
                                }
                                if ($action['status_id'] == 10 || $action['status_id'] == 2) {
                                    $border_class = "border-info";
                                    $badge_class = "bg-info";
                                    $text_class  = "text-info";
                                }
                            ?>
                            <div class="row no-gutters">
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
                                <div class="col-sm py-2">
                                    <div class="card <?php echo $border_class; ?> shadow">
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

<div class="modal fade" id="modal-add-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="../actions/update_department.php" method="post">
                <input type="hidden" name="department_id" id="department_id">
                <div class="modal-header px-4">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Department Name</h5>
                </div>
                <div class="modal-body px-4">

                    <div class="form-group row mb-6">

                        <div class="col-sm-8 col-lg-10">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Edit Department Name</label>
                                <input type="text" name="name" id="dep_name" required class="form-control" id="formGroupExampleInput" placeholder="Add New Department">
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


<?php require_once __DIR__ . "/layouts/footer.php" ?>