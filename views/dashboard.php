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
                        <h2 class="mb-1">
                          <?php
                          $book = new Book();
                      		$uk_all_records = $book->getAllCurrentBooks('uk');
                          $total_uk = $book->countTotal($uk_all_records);
                          echo $total_uk;
                          ?>
                        </h2>
                        <p>This week UK Books</p>
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
                          $book = new Book();
                          $usa_all_records = $book->getAllCurrentBooks('usa');
                          $total_usa = $book->countTotal($usa_all_records);
                          echo $total_usa;
                          ?>
                        </h2>
                        <p>This week USA Books</p>
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
                          $book = new Book();
                          $uae_all_records = $book->getAllCurrentBooks('uae');
                          $total_uae = $book->countTotal($uae_all_records);
                          echo $total_uae;
                          ?>
                        </h2>
                        <p>This week UAE Books</p>
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

                            echo $total_uk + $total_usa + $total_uae;
                            ?>
                        </h2>
                        <p>All Books this week</p>
                        <div class="chartjs-wrapper">
                            <canvas id="line"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-12">
                <!-- Recent Order Table -->
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <h2>Recent Books</h2>
                        <div class="">
                           <a href="books.php" class="btn btn-primary">All Books</a>
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

                                            $text_class = "text-primary";
                                            if ($book['status_id'] == 1 || $book['status_id'] == 13 || $book['status_id'] == 6) {
                                                $text_class  = "badge-primary";
                                            }
                                            if ($book['status_id'] == 2 || $book['status_id'] == 8 || $book['status_id'] == 10) {
                                                $text_class  = "badge-danger";
                                            }
                                            if ($book['status_id'] == 3 || $book['status_id'] == 7) {
                                                $text_class  = "badge-warning";
                                            }
                                            if ($book['status_id'] == 5 || $book['status_id'] == 11 || $book['status_id'] == 9) {
                                                $text_class  = "badge-success";
                                            }
                                            if ($book['status_id'] == 12 || $book['status_id'] == 4) {
                                                $text_class  = "badge-info";
                                            }

                                        ?>
                                        <span class="badge <?php echo $text_class; ?>"><?php echo $status->title;  ?></span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                                <li class="dropdown-item">
                                                    <a href="book-actions.php?id=<?php echo $book["id"]; ?>">View Action</a>
                                                </li>
                                                <!-- <li class="dropdown-item">
                                                    <a href="#">Remove</a>
                                                </li> -->
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
