<?php
require_once "../../config/init.php";

if($_POST){
  $check_id = $_POST['id'];
  $epub_check = new Epubcheck();
  $epub_check->find($check_id);
  if($epub_check->id){
    $validated = $epub_check->validated;
    $messages = json_decode($epub_check->messages,true);
    $checker = json_decode($epub_check->checker,true);
    $validated_at = $epub_check->validated_at;

    ?>
    <div class="row">
      <div class="col-12">
        <p>
          Status: <span class="btn btn-sm btn-<?php echo ($validated) ? 'success' : 'danger'; ?>"><?php echo ($validated) ? "Validated" : "Validation Failed"; ?></span>
        </p>
      </div>
      <?php  if(!$validated) { ?>
      <div class="col-12 mt-2">
        <p>
          Logs
        </p>
        <table class="table">
          <thead>
            <tr>
              <th>Type</th>
              <th>Message</th>
              <th>Locations</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach($messages as $msg){
                ?>
                <tr>
                  <td><?php echo $msg['severity']; ?></td>
                  <td style="width: 320px;"><?php echo $msg['message']; ?></td>
                  <td>
                    <?php
                    foreach($msg['locations'] as $loc){
                      echo "Path: ".$loc['path']."<br />";
                      echo "Line: ".$loc['line']."<br />";
                      echo "Colmn: ".$loc['column']."<br />";
                      echo "Context: ".$loc['context']."<br />";
                      echo "<br />";
                    }
                    ?>
                  </td>
                </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    <?php } ?>

    </div>
    <?php

  }else{
    echo "<p>
    Logs Not Found!
    </p>";

  }
}
