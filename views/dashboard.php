<?php
require_once __DIR__ . "/layouts/header.php";
?>

<div class="content-wrapper">
    <div class="content">
        <!-- Top Statistics -->
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4">
                    <div class="card-body">
                        <h2 class="mb-1">71,503</h2>
                        <p>Online Signups</p>
                        <div class="chartjs-wrapper">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini  mb-4">
                    <div class="card-body">
                        <h2 class="mb-1">
                            <?php

                            $book_query = new Book();
                            $s_date = date("Y-m-01");
                            $e_date = date("Y-m-t");
                            $book_query->where("publication_date", "$s_date", " >= ")->where("publication_date", "$e_date", " <= ");
                            $book_query->where("status_id", 10);
                            $books = $book_query->get();
                            // print_r($books);
                            // exit;
                            echo count($books);
                            ?>
                        </h2>
                        <p>Completed This Month</p>
                        <div class="chartjs-wrapper">
                            <canvas id="dual-line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4">
                    <div class="card-body">
                        <h2 class="mb-1">
                            <?php

                            $book_query = new Book();
                            $s_date = date("Y-m-01");
                            $e_date = date("Y-m-t");
                            $book_query->where("publication_date", "$s_date", " >= ")->where("publication_date", "$e_date", " <= ");
                            $book_query->where("status_id", 6);
                            $books = $book_query->get();
                            // print_r($books);
                            // exit;
                            echo count($books);
                            ?>
                        </h2>
                        <p>In Progress</p>
                        <div class="chartjs-wrapper">
                            <canvas id="area-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4">
                    <div class="card-body">
                        <h2 class="mb-1">
                            <?php

                            $book_query = new Book();
                            $s_date = date("Y-m-d");
                            $e_date = date("Y-m-d");
                            $book_query->where("publication_date", "$s_date", " >= ")->where("publication_date", "$e_date", " <= ");
                            $book_query->where("status_id", 10);
                            $books = $book_query->get();
                            // print_r($books);
                            // exit;
                            echo count($books);
                            ?>
                        </h2>
                        <p>Today Completed</p>
                        <div class="chartjs-wrapper">
                            <canvas id="line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


       

        <div class="row">
            <div class="col-xl-4 col-lg-6 col-12">

                 <!-- Doughnut Chart -->
                 <div class="card card-default" data-scroll-height="675">
                    <div class="card-header justify-content-center">
                        <h2>Orders Overview</h2>
                    </div>
                    <div class="card-body">
                        <canvas id="doChart"></canvas>
                    </div>
                    <a href="#" class="pb-5 d-block text-center text-muted"><i class="mdi mdi-download mr-2"></i> Download overall report</a>
                    <div class="card-footer d-flex flex-wrap bg-white p-0">
                        <div class="col-6">
                            <div class="py-4 px-4">
                                <ul class="d-flex flex-column justify-content-between">
                                    <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #4c84ff"></i>Order Completed</li>
                                    <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #80e1c1 "></i>Order Unpaid</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 border-left">
                            <div class="py-4 px-4 ">
                                <ul class="d-flex flex-column justify-content-between">
                                    <li class="mb-2"><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #8061ef"></i>Order Pending</li>
                                    <li><i class="mdi mdi-checkbox-blank-circle-outline mr-2" style="color: #ffa128"></i>Order Canceled</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xl-4 col-lg-6 col-12">
                <!-- Top Sell Table -->
                <div class="card card-table-border-none" data-scroll-height="674" style="height: 674px !important;overflow: hidden;">
                    <div class="card-header justify-content-between">
                        <h2>Sold by Units</h2>
                        <div>
                            <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-cached"></i></button>
                            <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-units" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-units">
                                    <li class="dropdown-item"><a href="#">Action</a></li>
                                    <li class="dropdown-item"><a href="#">Another action</a></li>
                                    <li class="dropdown-item"><a href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body slim-scroll py-0">
                        <table class="table ">
                            <tbody>
                                <tr>
                                    <td class="text-dark">Backpack</td>
                                    <td class="text-center">9</td>
                                    <td class="text-right">33% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                                </tr>
                                <tr>
                                    <td class="text-dark">T-Shirt</td>
                                    <td class="text-center">6</td>
                                    <td class="text-right">150% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Coat</td>
                                    <td class="text-center">3</td>
                                    <td class="text-right">50% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Necklace</td>
                                    <td class="text-center">7</td>
                                    <td class="text-right">150% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Jeans Pant</td>
                                    <td class="text-center">10</td>
                                    <td class="text-right">300% <i class="mdi mdi-arrow-down-bold text-danger pl-1 font-size-12"></i> </td>
                                </tr>
                                <tr>
                                    <td class="text-dark">Shoes</td>
                                    <td class="text-center">5</td>
                                    <td class="text-right">100% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                                </tr>
                                <tr>
                                    <td class="text-dark">T-Shirt</td>
                                    <td class="text-center">6</td>
                                    <td class="text-right">150% <i class="mdi mdi-arrow-up-bold text-success pl-1 font-size-12"></i> </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="card-footer bg-white py-4">
                        <a href="#" class="btn-link py-3 text-uppercase">View Report</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-12">
                <!-- Notification Table -->
                <div class="card card-default" data-scroll-height="674" style="height: 674px !important;overflow: hidden;">
                    <div class="card-header justify-content-between ">
                        <h2>Latest Notifications</h2>
                        <div>
                            <button class="text-black-50 mr-2 font-size-20"><i class="mdi mdi-cached"></i></button>
                            <div class="dropdown show d-inline-block widget-dropdown">
                                <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-notification">
                                    <li class="dropdown-item"><a href="#">Action</a></li>
                                    <li class="dropdown-item"><a href="#">Another action</a></li>
                                    <li class="dropdown-item"><a href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="card-body slim-scroll">
                        <div class="media pb-3 align-items-center justify-content-between">
                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                <i class="mdi mdi-cart-outline font-size-20"></i>
                            </div>
                            <div class="media-body pr-3 ">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New Order</a>
                                <p>Selena has placed an new order</p>
                            </div>
                            <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                        </div>

                        <div class="media py-3 align-items-center justify-content-between">
                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                                <i class="mdi mdi-email-outline font-size-20"></i>
                            </div>
                            <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New Enquiry</a>
                                <p>Phileine has placed an new order</p>
                            </div>
                            <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 9 AM</span>
                        </div>


                        <div class="media py-3 align-items-center justify-content-between">
                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                <i class="mdi mdi-stack-exchange font-size-20"></i>
                            </div>
                            <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Support Ticket</a>
                                <p>Emma has placed an new order</p>
                            </div>
                            <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                        </div>

                        <div class="media py-3 align-items-center justify-content-between">
                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-primary text-white">
                                <i class="mdi mdi-cart-outline font-size-20"></i>
                            </div>
                            <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New order</a>
                                <p>Ryan has placed an new order</p>
                            </div>
                            <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                        </div>

                        <div class="media py-3 align-items-center justify-content-between">
                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-info text-white">
                                <i class="mdi mdi-calendar-blank font-size-20"></i>
                            </div>
                            <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="">Comapny Meetup</a>
                                <p>Phileine has placed an new order</p>
                            </div>
                            <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                        </div>

                        <div class="media py-3 align-items-center justify-content-between">
                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-warning text-white">
                                <i class="mdi mdi-stack-exchange font-size-20"></i>
                            </div>
                            <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">Support Ticket</a>
                                <p>Emma has placed an new order</p>
                            </div>
                            <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 10 AM</span>
                        </div>

                        <div class="media py-3 align-items-center justify-content-between">
                            <div class="d-flex rounded-circle align-items-center justify-content-center mr-3 media-icon iconbox-45 bg-success text-white">
                                <i class="mdi mdi-email-outline font-size-20"></i>
                            </div>
                            <div class="media-body pr-3">
                                <a class="mt-0 mb-1 font-size-15 text-dark" href="#">New Enquiry</a>
                                <p>Phileine has placed an new order</p>
                            </div>
                            <span class=" font-size-12 d-inline-block"><i class="mdi mdi-clock-outline"></i> 9 AM</span>
                        </div>

                    </div>
                    <div class="mt-3"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <!-- Recent Order Table -->
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <h2>Recent Books</h2>
                        <div class="date-range-report ">
                            <span></span>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Book ID</th>
                                    <th>Book Title</th>
                                    <th>ISBN</th>
                                    <th>Penname</th>
                                    <th>Publication Date</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                $query = new Book();
                                $books = $query->all();
                                foreach($books as $book) {?>
                                <tr>
                                    <td><?php echo $book['id']; ?></td>
                                    <td>
                                        <p class="text-dark" href=""><?php echo $book['book_title'];?></p>
                                    </td>
                                    <td class="d-none d-lg-table-cell"><?php echo $book['isbn']; ?></td>
                                    <td class="d-none d-lg-table-cell"><?php echo $book['penname']; ?></td>
                                    <td class="d-none d-lg-table-cell"><?php echo $book['publication_date']; ?></td>
                                    <td>
                                        <?php 
                                            $status = new Status();
                                            $status->find($book['status_id']); 
                                        ?>
                                        <span class="badge badge-success"><?php echo $status->title;  ?></span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                                <li class="dropdown-item">
                                                    <a href="#">View</a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="#">Remove</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
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





<?php
require_once __DIR__ . "/layouts/footer.php";
?>