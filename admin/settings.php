<?php require_once('header.php'); ?>
<?php
if(isset($_POST['form1'])) {
	$valid = 1;

	$path = $_FILES['photo_logo']['name'];
    $path_tmp = $_FILES['photo_logo']['tmp_name'];

    if($path == '') {
    	$valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }
    if($valid == 1) {

    	// removing the existing photo
    	$statement = $pdo->prepare("SELECT * FROM mokomeme_settings WHERE id=1");
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
    	foreach ($result as $row) {
    		$logo = $row['logo'];
    		unlink('../assets/images/'.$logo);
    	}
    	// updating the data
    	$final_name = 'logo'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/images/'.$final_name );
        // updating the database
		$statement = $pdo->prepare("UPDATE mokomeme_settings SET logo=? WHERE id=1");
		$statement->execute(array($final_name));

        $success_message = 'Logo is updated successfully.';	
    }
}
if(isset($_POST['form2'])) {
	$valid = 1;
	$path = $_FILES['photo_favicon']['name'];
    $path_tmp = $_FILES['photo_favicon']['tmp_name'];
    if($path == '') {
    	$valid = 0;
        $error_message .= 'You must have to select a photo<br>';
    } else {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }
    if($valid == 1) {
    	// removing the existing photo
    	$statement = $pdo->prepare("SELECT * FROM mokomeme_settings WHERE id=1");
    	$statement->execute();
    	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
    	foreach ($result as $row) {
    		$favicon = $row['favicon'];
    		unlink('../assets/images/'.$favicon);
    	}
    	// updating the data
    	$final_name = 'favicon'.'.'.$ext;
        move_uploaded_file( $path_tmp, '../assets/images/'.$final_name );	
        // updating the database
	$statement = $pdo->prepare("UPDATE mokomeme_settings SET favicon=? WHERE id=1");
	$statement->execute(array($final_name));
        $success_message = 'Favicon is updated successfully.';
    }
}
if(isset($_POST['form4'])) {
	// updating the database
	$statement = $pdo->prepare("UPDATE mokomeme_settings SET receive_email=?, send_email=? WHERE id=1");
	$statement->execute(array($_POST['receive_email'],$_POST['send_email']));
	$success_message = 'Contact form settings information is updated successfully.';
}
if(isset($_POST['form6'])) {
	// updating the database
	$statement = $pdo->prepare("UPDATE mokomeme_settings SET meta_title_home=?, meta_keyword_home=?, meta_description_home=?, max_images=? WHERE id=1");
	$statement->execute(array($_POST['meta_title_home'],$_POST['meta_keyword_home'],$_POST['meta_description_home'],$_POST['max_images']));
	$success_message = 'SEO settings is updated successfully.';
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Settings</h1>
	</div>
</section>
<?php
$statement = $pdo->prepare("SELECT * FROM mokomeme_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$logo                            = $row['logo'];
	$favicon                         = $row['favicon'];
	$receive_email                   = $row['receive_email'];
	$send_email		         = $row['send_email'];
	$meta_title_home                 = $row['meta_title_home'];
	$meta_keyword_home               = $row['meta_keyword_home'];
	$meta_description_home           = $row['meta_description_home'];
	$max_images			 = $row['max_images'];
}
?>
<section class="content" style="min-height:auto;margin-bottom: -30px;">
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
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">						
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">Logo</a></li>
						<li><a href="#tab_2" data-toggle="tab">Favicon</a></li>
						<li><a href="#tab_4" data-toggle="tab">Email Settings</a></li>
						<li><a href="#tab_6" data-toggle="tab">SEO Settings</a></li>
					</ul>
					<div class="tab-content">
          				<div class="tab-pane active" id="tab_1">
          					<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          					<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">Existing Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <img src="../assets/images/<?php echo $logo; ?>" class="existing-photo" style="height:80px;">
							            </div>
							        </div>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <input type="file" name="photo_logo">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form1">Update Logo</button>
										</div>
									</div>
								</div>
							</div>
							</form>
          				</div>
          				<div class="tab-pane" id="tab_2">
          					<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">Existing Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <img src="../assets/images/<?php echo $favicon; ?>" class="existing-photo" style="height:40px;">
							            </div>
							        </div>
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <input type="file" name="photo_favicon">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
										<button type="submit" class="btn btn-success pull-left" name="form2">Update Favicon</button>
										</div>
									</div>
								</div>
							</div>
							</form>
          				</div>
          				<div class="tab-pane" id="tab_4">

          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Receiver Email Address <span>*</span></label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="receive_email" value="<?php echo $receive_email; ?>">
										</div>
									</div>									
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Sender Email Address <span>*</span></label>
										<div class="col-sm-4">
										<input type="text" class="form-control" name="send_email" value="<?php echo $send_email; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form4">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>
          				</div>
          				<div class="tab-pane" id="tab_6">

          					<form class="form-horizontal" action="" method="post">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Title </label>
										<div class="col-sm-9">
											<input type="text" name="meta_title_home" class="form-control" value="<?php echo $meta_title_home ?>">
										</div>
									</div>		
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Keyword </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="meta_keyword_home" style="height:100px;"><?php echo $meta_keyword_home ?></textarea>
										</div>
									</div>	
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Meta Description </label>
										<div class="col-sm-9">
											<textarea class="form-control" name="meta_description_home" style="height:200px;"><?php echo $meta_description_home ?></textarea>
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label">Max Images on Homepage <span>*</span></label>
										<div class="col-sm-4">
										<input type="number" class="form-control" name="max_images" value="<?php echo $max_images; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form6">Update</button>
										</div>
									</div>
								</div>
							</div>
							</form>
          				</div>
          			</div>
				</div>
			</form>
		</div>
	</div>
</section>
<?php require_once('footer.php'); ?>