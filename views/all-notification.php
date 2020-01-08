<?php 
   require_once __DIR__."/../config/init.php";
   require_once __DIR__."/layouts/header.php";
   $user_id = Session::get('user_id');
   $user_detail = new User();
   $user_detail->find($user_id);

?>
<div class="content-wrapper">
  <div class="content">
	 <div class="row">
       <div class="col-12">
    <!-- Recent Order Table -->
  		  <div class="card card-table-border-none" id="recent-orders">
      		<div class="card-header justify-content-between">
          	  <h2>All Notifications</h2>
          	</div>
     	    <div class="card-body pt-0 pb-5 mx-5">
     	      <table class="table card-table table-responsive table-responsive-large" style="width:100%">
				<thead>
			      <tr>
					<th><b>Title</b></th>
					<th><b>Detail</b></th>
					<th><b>Book Name</b></th>
					<th><b>Day Time</b></th>
					<th><b>Action</b></th>
				  </tr>
			    </thead>
				<?php
			      $read_notification = new Notification();
			      $read_notification->Where("user_id","$user_id")->Where("notification_read","0");
			      $notifications = $read_notification->get();
			    ?>
			    
			    
			    <?php 
			      foreach ($notifications as $notification) {
			         ?>
			    <tr>
			    	<td>
			    		<i class="mdi mdi-message-plus"></i> <?php echo $notification['title']; ?>
			    	</td>
			    	<td>
			    		<i class="mdi mdi-message-plus"></i> <?php echo $notification['details']; ?>
			    	</td>
			    	<td>
			    		<i class="mdi mdi-message-plus"></i> 
			    		<?php
			    		 $book_id = $notification['book_id'];
			    		 $book = new Book();
			    		 $book->find($book_id);
			    		 echo $book->book_title;
			    	    ?>
			    	</td>
			    	<td>
			    		<i class="mdi mdi-clock-outline"></i> <?php echo $notification['notify_at']; ?>
			    	</td>
			    	<td>
			    		<a class="btn btn-warning" href="../actions/read_notification.php?id=<?php echo $notification['id'];?>">Mark as Read</a>
			    	</td>
			    </tr>
			      
			    <?php  
			      }
			    ?>
            </table>         
        </div>
    </div>
  </div>
</div>

  </div>
</div>
        	

<?php
   require_once __DIR__."/layouts/footer.php";
?>