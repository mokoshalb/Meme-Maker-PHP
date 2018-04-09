<?php require_once('header.php'); ?>
<?php
if(isset($_POST['form1'])) {
$valid = 1;
$path = $_FILES['photo']['name'];
$path_tmp = $_FILES['photo']['tmp_name'];
if($path == '') {
	$valid  = 0;
        $error_message  .= 'You must select a photo';
 	} else {
    		$ext = pathinfo( $path, PATHINFO_EXTENSION );
    		if($ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif') {
    		$valid  = 0;
        	$error_message .= 'You have to upload a jpg, jpeg, gif or png file';
    		}
	}
if($valid == 1){
    	$id = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    	$imageid = str_shuffle($id);
    	$imageid = substr($imageid,0,10);
    	// uploading the photo into the main location and giving it a final name
    	$filename = $imageid.'.'.$ext;
    	move_uploaded_file($path_tmp, '../assets/images/'.$filename);
	// saving into the database
	$statement = $pdo->prepare("INSERT INTO mokomeme_images (images_title, images_ext) VALUES (?,?)");
	$statement->execute(array($imageid, $ext));
	//$last_id = $pdo->lastInsertId();
	$success_message = 'Image is added successfully!';
}
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Add Image</h1>
	</div>
	<div class="content-header-right">
		<a href="image.php" class="btn btn-primary btn-sm">View All</a>
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
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Image <span>*</span></label>
							<div class="col-sm-4">
<input type="file" name="photo" id="photo" class="dropify-image" data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg gif"/>
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
<script type="text/javascript" src="js/dropify.js"></script>
<script type="text/javascript">
$(document).ready(function(){
        // Basic
        $('.dropify').dropify();
        $('.dropify-image').dropify({
            messages: {
                default : '<center>Drag and drop a image here or click</center>',
                error   : 'Ooops, something wrong appended.'
            },
            error: {
                'fileSize': '<center>The file size is too big! ({{ value }} max).</center>',
                'minWidth': '<center>The image width is too small ({{ value }}}px min).</center>',
                'maxWidth': '<center>The image width is too big ({{ value }}}px max).</center>',
                'minHeight': '<center>The image height is too small ({{ value }}}px min).</center>',
                'maxHeight': '<center>The image height is too big ({{ value }}px max).</center>',
                'imageFormat': '<center>The image format is not allowed ({{ value }} only).</center>',
                'fileExtension': '<center>The file is not allowed ({{ value }} only).</center>'
            },
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element){
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element){
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element){
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e){
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>
<?php require_once('footer.php'); ?>