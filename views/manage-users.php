<?php
require_once __DIR__ . "/layouts/header.php";
?>



<div class="content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <h1>Users</h1>

            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb p-0">
                    <li class="breadcrumb-item">
                        <a href="index.html">
                            <span class="mdi mdi-home"></span>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        tables
                    </li>
                    <li class="breadcrumb-item" aria-current="page">basic-tables</li>
                </ol>
            </nav> -->
            <div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-user"> Add New User
                </button>
            </div>
        </div>

        <!-- Add User Button  -->
        <div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="../actions/add_user.php" method="post">
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Create New User</h5>
                        </div>
                        <div class="modal-body px-4">
                            <div class="row mb-2">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="firstName">First name</label>
                                        <input type="text" name="firstname" class="form-control" id="firstName" value="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="lastName">Last name</label>
                                        <input type="text" name="lastname" class="form-control" id="lastName" value="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" autocomplete="off" id="email" value="">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group mb-4">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control" autocomplete="off" id="email" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-6">
                                <label for="coverImage" class="col-sm-4 col-lg-2 col-form-label"> Department</label>
                                <div class="col-sm-8 col-lg-10">
                                    <div class="custom-file mb-1">
                                        <select class="form-control" name="department_id" id="">
                                            <?php
                                            $query = new Department();
                                            $departments = $query->all();

                                            foreach ($departments as $department) {


                                                echo  "<option value='" . $department['id'] . "'>" . $department['name'] . "</option>";
                                            }

                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary btn-pill">Save Contact</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Recent Order Table -->
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <h2>All Users</h2>
                        <div class="
                         ">
                            <span></span>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Password</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = new User();
                                $users = $query->all();
                                // print_r($users);
                                // exit;
                                foreach ($users as $user) {
                                ?>
                                    <tr>
                                        <td><?php echo $user['id']; ?></td>
                                        <td>
                                            <p class="text-dark"> <?php echo $user['firstname'] . " " .  $user['lastname']; ?></p>

                                        </td>
                                        <td>
                                            <p class="text-dark"> <?php echo $user['email']; ?></p>

                                        </td>
                                        <td>
                                            <?php
                                             $department = new Department();

                                            $department->find($user['department_id']);

                                            ?>
                                            <p class="text-dark"> <?php echo $department->name; ?></p>

                                        </td>
                                        <td>
                                            <p class="text-dark"> <?php echo $user['password']; ?></p>

                                        </td>
                                        <td>
                                            <p class="text-dark"> <?php echo $user['status'] == 1 ? "Active" : "Inactive";  ?></p>
                                        </td>

                                        <td class="text-right">
                                            <div class="dropdown show d-inline-block widget-dropdown">
                                                <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                                    <li class="dropdown-item">
                                                        <a href="#" onclick="showEditForm(<?php echo $user['id']; ?>,'<?php echo $user['name']; ?>')">Edit</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="../actions/delete_user.php?user_id=<?php echo $user['id'] ?>">Delete</a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <?php
                                                        if ($user['status'] == 1) {
                                                            echo  "<a href='../actions/user_status.php?user_id= " . $user['id'] . "&status=0'>Block</a>";
                                                        } else {
                                                            echo  "<a href='../actions/user_status.php?user_id= " . $user['id'] . "&status=1'>Unblock</a>";
                                                        }
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Edit Department model Button  -->

                                    <?php

                                    // $departments = $query->find($department['id']);

                                    ?>


                                <?php } ?>

                            </tbody>
                        </table>
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
