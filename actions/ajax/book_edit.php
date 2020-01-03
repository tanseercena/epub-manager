<?php 
require_once "../../config/init.php";

if($_POST){
    $book_id = $_POST['book_id'];
    $book = new Book();
    $book->find($book_id);

    ?>
    <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
    <div class="form-group row mb-6">
        <div class="col-sm-8 col-lg-10">
            <div class="form-group">
                <?php 
                    if($book->cover){
                        echo '<img src="'.$base_url.'/testing/'.$book->cover.'" style="width: 120px;"><br>';
                    }
                ?>
                <label for="formGroupExampleInput">Book Cover</label>
                <input type="file" name="cover" class="form-control "  id="formGroupExampleInput" >
            </div>
        </div>
    </div>

    <div class="form-group row mb-6">
        <div class="col-sm-8 col-lg-10">
            <div class="form-group">
                <label for="formGroupExampleInput">Book Title</label>
                <input type="text" value="<?php echo $book->book_title; ?>" name="book_title" required class="form-control"  placeholder="Book Title">
            </div>
        </div>
    </div>

    <div class="form-group row mb-6">
        <div class="col-sm-8 col-lg-10">
            <div class="form-group">
                <label for="formGroupExampleInput">Penname</label>
                <input type="text" value="<?php echo $book->penname; ?>" name="penname" required class="form-control"  placeholder="Penname">
            </div>
        </div>
    </div>

    <div class="form-group row mb-6">
        <div class="col-sm-8 col-lg-10">
            <div class="form-group">
                <label for="formGroupExampleInput">ISBN</label>
                <input type="text" value="<?php echo $book->isbn; ?>" name="isbn" required class="form-control"  placeholder="ISBN">
            </div>
        </div>
    </div>

    <div class="form-group row mb-6">
        <div class="col-sm-8 col-lg-10">
            <div class="form-group">
                <label for="formGroupExampleInput">Publication Date</label>
                <input type="date" value="<?php echo $book->publication_date; ?>" name="publication_date" required class="form-control"  placeholder="Publication Date">
            </div>
        </div>
    </div>

    <div class="form-group row mb-6">
        <div class="col-sm-8 col-lg-10">
            <div class="form-group">
                <label for="formGroupExampleInput">Book Origin</label>
                <select id="book_origin" name="book_origin"  class="form-control mt-2">
                    <option value="">Select Origin</option>
                    <option value="uk" <?php echo $book->book_origin == 'uk' ? 'selected' : '' ?>>UK</option>
                    <option value="usa" <?php echo $book->book_origin == 'usa' ? 'selected' : '' ?>>USA</option>
                    <option value="uae" <?php echo $book->book_origin == 'uae' ? 'selected' : '' ?>>UAE</option>
                </select>
            </div>
        </div>
    </div>

    <?php
}