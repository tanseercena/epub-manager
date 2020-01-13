<?php
require_once __DIR__ . "/layouts/header.php";
?>



<div class="content-wrapper">
    <div class="content">
        <div class="breadcrumb-wrapper breadcrumb-contacts">
            <h1>Books</h1>

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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-contact"> Add New Book
                </button>
            </div>
        </div>


        <!-- Add Department model Button -->
        <div class="modal fade" id="modal-add-contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <form action="../actions/add_book.php" method="post" enctype="multipart/form-data" >
                        <div class="modal-header px-4">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Add New Book</h5>
                        </div>
                        <div class="modal-body px-4">
                            <div class="form-group row mb-6">
                                 <div class="col-sm-4 col-lg-6">
                                    <div class="form-group">
                                        <label class="mt-3">Upload File</label>
                                        <input type="file" name="fileToUpload"  class="form-control "  id="formGroupExampleInput"  enctype="multipart/form-data">
                                        <label class="mt-3">Penname/Author's Name</label>
                                        <input type="text" name="penname" required class="form-control" id="formGroupExampleInput" >
                                        <label class="mt-3">Publicatoin Date</label>
                                        <input type="Date" name="publication_date" required class="form-control" id="formGroupExampleInput" >
                                        <label class="mt-3">Book Origin</label>
                                        <select id="book_origin" name="book_origin"  class="form-control">
                                            <option  value="">Select Origin</option>
                                            <option value="uk">UK</option>
                                            <option value="usa">USA</option>
                                            <option value="uae">UAE</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-lg-6">
                                    <div class="form-group">
                                        <label class="mt-3">Book Name</label>
                                        <input type="text" name="book_title" required class="form-control  " id="formGroupExampleInput" >
                                        <label class="mt-3">Book ISBN</label>
                                        <input type="text" name="isbn" required class="form-control" id="formGroupExampleInput" >
                                        <label class="mt-3">Status</label>
                                        <select class="form-control"  name="status_id" >
                                            <option  value="">Select Status</option>
                                            <?php
                                               $value = new Status;
                                               $statuses = $value->all();
                                               foreach ($statuses as $status) {
                                                   echo "<option value='$status[id]'>".$status["title"]."</option>";
                                                }
                                            ?>
                                        </select>
                                        <label class="mt-3">Book Type</label>
                                        <select id="book_type" name="book_type"  class="form-control">
                                            <option  value="">Select Type</option>
                                            <option value="text">Text</option>
                                            <option value="indesign">Indesign</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer px-4">
                            <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="submit" class="btn btn-primary btn-pill">Add Book</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-12 ">
                <form class="form-group form-inline" method="POST" action="">
                    <select id="book_origin" name="book_origin"  class="form-control mr-5 ml-2 ">
                        <option  value="">Select Origin</option>
                        <option value="uk">UK</option>
                        <option value="usa">USA</option>
                        <option value="uae">UAE</option>
                    </select>
                   <input type="text" name="Author_name"   class="form-control " id="formGroupExampleInput" placeholder="Penname/Author Name" >
                   <input type="date" name="date_from"   class="form-control " id="formGroupExampleInput" placeholder="Publication Date From" >
                   <input type="date" name="date_to"  class="form-control" id="formGroupExampleInput" placeholder="Publication Date To" >
                   <button type="submit" name="submit1" class="btn btn-primary btn-pill ml-5">Search</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Recent Order Table -->
                <div class="card card-table-border-none" id="recent-orders">
                    <div class="card-header justify-content-between">
                        <h2>All Books</h2>
                        <div class="
                         ">
                            <span></span>
                        </div>
                    </div>
                    <div class="card-body pt-0 pb-5">
                        <table class="table card-table table-responsive table-responsive-large " style="width:100%">
                            <thead>
                                <tr>
                                    <th>Book ID</th>
                                    <th>Book Title</th>
                                    <th>Front Cover</th>
                                    <th>Penname</th>
                                    <th>Book ISBN</th>
                                    <th>Publication Date</th>
                                    <th>Book Origin</th>
                                    <th>Status </th>
                                    <th>Book Type</th>
                                 </tr>
                            </thead>
                            <tbody>
                                <?php
                                 $query = new Book;
                                 if (isset($_POST["submit1"])) {
                                    if (!empty($_POST['Author_name'])) {
                                        $Author_name = $_POST["Author_name"];
                                        $query->orWhere("book_title","%$Author_name%","LIKE")->orWhere("penname","%$Author_name%","LIKE");

                                    }
                                    if (!empty($_POST['date_from']) && !empty($_POST['date_to'])){
                                        $date_from = $_POST["date_from"];
                                        $date_to = $_POST["date_to"];
                                        $query->Where("publication_date","$date_to","<=")->Where("publication_date","$date_from",">=");
                                    }
                                    if (!empty($_POST['book_origin'])){
                                        $book_origin = $_POST["book_origin"];
                                        $date_to = $_POST["date_to"];
                                        $query->Where("book_origin","$book_origin","=");
                                    }
                                    $books = $query->get();
                                    if (count($books) == 0) {
                                      echo "<h4 class='text-center text-danger font-weight-bold'>No Book Found</h4>";
                                  }
                                 }
                                 else{
                                    $books = $query->all();
                                 }
                                    foreach ($books as $book) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $book['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $book['book_title'];?>
                                    </td>
                                    <td>



                                         <?php
                                           if (!empty($book['cover'])) {
                                              ?>
                                            <img src="../assets/img/book-covers/<?php
                                            echo $book['cover'];?>" width="50" height="50">
                                           <?php
                                           }
                                           else{
                                            ?>
                                            <img src="../assets/img/book-covers/img-not-found.png" width="50" height="50">
                                            <?php
                                           }
                                         ?>
                                    </td>
                                    <td>
                                         <?php echo $book['penname']; ?>
                                    </td>
                                    <td>
                                        <?php echo $book['isbn']; ?>
                                    </td>
                                    <td>
                                        <?php echo $book['publication_date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $book['book_origin']; ?>
                                    </td>
                                    <td>
                                        <?php
                                          $status_id = $book['status_id'];
                                          $status = new Status;
                                          $status->find($status_id);
                                          echo $status->title;
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $book['book_type']; ?>
                                    </td>
                                       <td class="text-right">
                                            <div class="dropdown show d-inline-block widget-dropdown">
                                                <a class="dropdown-toggle icon-burger-mini" href="" role="button" id="dropdown-recent-order1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static"></a>
                                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-recent-order1">
                                                    <li class="dropdown-item">
                                                        <!-- <a href="#" onclick="showEditForm(<?php //echo $department['id']; ?>,'<?php //echo $department['name']; ?>')">Edit</a> -->
                                                         <button type="button" onclick="showEditForm(<?php echo $book['id'];?>)"> Edit Book </button>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <a href="../actions/delete_book.php?book_id=<?php echo $book['id'] ?>">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                <?php  }?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>

<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

        <div class="modal-header px-4">
            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Book</h5>
        </div>

        <div class="modal-body px-4">
        <form action="<?php echo $base_url; ?>actions/update_book.php" method="post" enctype="multipart/form-data">
                <div id="edit-form"></div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-secondary btn-pill" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-pill">Update Book</button>
                </div>
            </form>
        </div>

        </div>
    </div>
</div>

<script>
    function showEditForm(id) {
        //console.log(id);
        $.ajax({
            url: "<?php echo $base_url ?>actions/ajax/book_edit.php",
            type: "POST",
            data: {book_id: id},
            success: function(resp){
                $("#edit-form").html(resp);
                $('#modal-edit').modal('show');
            }
        });

    }
</script>
<?php require_once __DIR__ . "/layouts/footer.php" ?>
