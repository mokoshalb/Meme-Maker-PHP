<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	$valid = 1;

    if(empty($_POST['page_name'])) {
        $valid = 0;
        $error_message .= "Page Name can not be empty<br>";
    } else {
    	// Duplicate Page checking
    	$statement = $pdo->prepare("SELECT * FROM mokomeme_page WHERE page_name=?");
    	$statement->execute(array($_POST['page_name']));
    	$total = $statement->rowCount();
    	if($total) {
    		$valid = 0;
        	$error_message .= "Page Title already exists<br>";
    	}
    }

    if($valid == 1) {
    		// generate slug
    		$temp_string = strtolower($_POST['page_name']);
    		$page_slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $temp_string);
    	// if slug already exists, then rename it
		$statement = $pdo->prepare("SELECT * FROM mokomeme_page WHERE page_slug=?");
		$statement->execute(array($page_slug));
		$total = $statement->rowCount();
		if($total) {
			$page_slug = $page_slug.'-1';
		}
		// saving into the database
		$statement = $pdo->prepare("INSERT INTO mokomeme_page (page_name,page_slug,page_content,page_layout) VALUES (?,?,?,?)");
		$statement->execute(array($_POST['page_name'],$page_slug,$_POST['page_content'],$_POST['page_layout']));
    	$success_message = 'Page is added successfully.';
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Page</h1>
	</div>
	<div class="content-header-right">
		<a href="page.php" class="btn btn-primary btn-sm">View All</a>
	</div>
</section>


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
								<input type="text" class="form-control" name="page_name" placeholder="Example: About Us">
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Page Content </label>
							<div class="col-sm-9">
								<textarea class="form-control" name="page_content" id="editor1"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Page Layout </label>
							<div class="col-sm-4">
								<select class="form-control" name="page_layout">
									<option value="Full Width">Full Width</option>
									<option value="Contact Us">Contact Us</option>
								</select>
							</div>
						</div>
						<div class="form-group">
                					<label for="" class="col-sm-2 control-label"></label>
                    					<div class="col-sm-6">
                      						<button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
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