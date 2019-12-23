<?php
require_once __DIR__ . "/layouts/header.php";
?>



<div class="content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <h1>Tables</h1>

            <nav aria-label="breadcrumb">
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
            </nav>
            <div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> Add New Department
    </button>
  </div>
        </div>

      

        <div class="row">
            <div class="col-12">
                <!-- Recent Order Table -->
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <h2>Recent Orders</h2>
                        <div class="
                         ">
                            <span></span>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <table class="table card-table table-responsive table-responsive-large" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Name</th>
                                    <th class="d-none d-lg-table-cell">Units</th>
                                    <th class="d-none d-lg-table-cell">Order Date</th>
                                    <th class="d-none d-lg-table-cell">Order Cost</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>24541</td>
                                    <td>
                                        <a class="text-dark" href=""> Coach Swagger</a>
                                    </td>
                                    <td class="d-none d-lg-table-cell">1 Unit</td>
                                    <td class="d-none d-lg-table-cell">Oct 20, 2018</td>
                                    <td class="d-none d-lg-table-cell">$230</td>
                                    <td>
                                        <span class="badge badge-success">Completed</span>
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
                                <tr>
                                    <td>24541</td>
                                    <td>
                                        <a class="text-dark" href=""> Toddler Shoes, Gucci Watch</a>
                                    </td>
                                    <td class="d-none d-lg-table-cell">2 Units</td>
                                    <td class="d-none d-lg-table-cell">Nov 15, 2018</td>
                                    <td class="d-none d-lg-table-cell">$550</td>
                                    <td>
                                        <span class="badge badge-warning">Delayed</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order2">
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
                                <tr>
                                    <td>24541</td>
                                    <td>
                                        <a class="text-dark" href=""> Hat Black Suits</a>
                                    </td>
                                    <td class="d-none d-lg-table-cell">1 Unit</td>
                                    <td class="d-none d-lg-table-cell">Nov 18, 2018</td>
                                    <td class="d-none d-lg-table-cell">$325</td>
                                    <td>
                                        <span class="badge badge-warning">On Hold</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order3">
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
                                <tr>
                                    <td>24541</td>
                                    <td>
                                        <a class="text-dark" href=""> Backpack Gents, Swimming Cap Slin</a>
                                    </td>
                                    <td class="d-none d-lg-table-cell">5 Units</td>
                                    <td class="d-none d-lg-table-cell">Dec 13, 2018</td>
                                    <td class="d-none d-lg-table-cell">$200</td>
                                    <td>
                                        <span class="badge badge-success">Completed</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order4">
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
                                <tr>
                                    <td>24541</td>
                                    <td>
                                        <a class="text-dark" href=""> Speed 500 Ignite</a>
                                    </td>
                                    <td class="d-none d-lg-table-cell">1 Unit</td>
                                    <td class="d-none d-lg-table-cell">Dec 23, 2018</td>
                                    <td class="d-none d-lg-table-cell">$150</td>
                                    <td>
                                        <span class="badge badge-danger">Cancelled</span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown show d-inline-block widget-dropdown">
                                            <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdown-recent-order5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order5">
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


<?php require_once __DIR__ . "/layouts/footer.php" ?>