<?php require_once('header.php'); ?>
<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['page_name'])) {
        $valid = 0;
        $error_message .= "Page Name can not be empty<br>";
    } else {
		// Duplicate Page checking
    	// current page name that is in the database
    	$statement = $pdo->prepare("SELECT * FROM mokomeme_page WHERE page_id=?");
		$statement->execute(array($_REQUEST['id']));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $row) {
			$current_page_name = $row['page_name'];
		}

		$statement = $pdo->prepare("SELECT * FROM mokomeme_page WHERE page_name=? and page_name!=?");
    	$statement->execute(array($_POST['page_name'],$current_page_name));
    	$total = $statement->rowCount();							
    	if($total) {
    		$valid = 0;
        	$error_message .= 'Page name already exists<br>';
    	}
    }

    if($valid == 1) {
		// generate slug
    		$temp_string = strtolower($_POST['page_slug']);
    		$page_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);;

    	// if slug already exists, then rename it
		$statement = $pdo->prepare("SELECT * FROM mokomeme_page WHERE page_slug=? AND page_name!=?");
		$statement->execute(array($page_slug,$current_page_name));
		$total = $statement->rowCount();
		if($total) {
			$page_slug = $page_slug.'-1';
		}
    
		// updating into the database
		$statement = $pdo->prepare("UPDATE mokomeme_page SET page_name=?, page_slug=?, page_content=?,page_layout=? WHERE page_id=?");
		$statement->execute(array($_POST['page_name'],$page_slug,$_POST['page_content'],$_POST['page_layout'],$_REQUEST['id']));
    	$success_message = 'Page is updated successfully.';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM mokomeme_page WHERE page_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	$result = $statement->fetchAll(PDO::FETCH_ASSOC);
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Page</h1>
	</div>
	<div class="content-header-right">
		<a href="page.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


<?php							
foreach ($result as $row) {
	$page_name = $row['page_name'];
	$page_slug = $row['page_slug'];
	$page_content = $row['page_content'];
	$page_layout = $row['page_layout'];
}
?>

<section class="content">

  <div class="row">
    <div class="col-md-12">

		<?php if($error_message): ?>
		<div class="callout callout-danger">
		<h4>Please correct the following errors:</h4>
		<p>
		<?php echo $error_message; ?>
		</p>
		</div>
		<?php endif; ?>

		<?php if($success_message): ?>
		<div class="callout callout-success">
		<h4>Success:</h4>
		<p><?php echo $success_message; ?></p>
		</div>
		<?php endif; ?>

        <form class="form-horizontal" action="" method="post">

        <div class="box box-info">

            <div class="box-body">
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Page Name <span>*</span></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="page_name" value="<?php echo $page_name; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Page Slug</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="page_slug" value="<?php echo $page_slug; ?>">
                    </div>
                </div>
                <div class="form-group">
					<label for="" class="col-sm-2 control-label">Page Content </label>
					<div class="col-sm-9">
						<textarea class="form-control" name="page_content" id="editor1"><?php echo $page_content; ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="" class="col-sm-2 control-label">Page Layout </label>
					<div class="col-sm-4">
						<select class="form-control" name="page_layout">
							<option value="Full Width" <?php if($page_layout=='Full Width') {echo 'selected';} ?>>Full Width</option>
							<option value="Contact Us" <?php if($page_layout=='Contact Us') {echo 'selected';} ?>>Contact Us</option>
						</select>
					</div>
				</div>
                <div class="form-group">
                	<label for="" class="col-sm-2 control-label"></label>
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-success pull-left" name="form1">Update</button>
                    </div>
                </div>

            </div>
        </div>
        </form>
    </div>
  </div>
</section>
<script src="ckeditor/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function () {
CKEDITOR.replace( 'editor1' );
});
</script>
<?php require_once('footer.php'); ?>