<?php require_once('header.php'); ?>
<?php
if(isset($_POST['form1'])) {
// updating the database
$statement = $pdo->prepare("UPDATE mokomeme_ads SET ads_code=? WHERE ads_id=1");
$statement->execute(array($_POST['ads_code']));
$success_message = 'Advertisement is updated successfully.';
}
?>
<section class="content-header">
	<div class="content-header-left">
		<h1>Advertisement</h1>
	</div>
</section>
<?php
$statement = $pdo->prepare("SELECT * FROM mokomeme_ads");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$ads_code = $row['ads_code'];
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
			<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label for="" class="col-sm-2 control-label">Ads Code: </label>
							<div class="col-sm-9">
							        <textarea class="form-control" rows="15" name="ads_code"><?php echo $ads_code; ?></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="" class="col-sm-2 control-label"></label>
							<div class="col-sm-6">
								<button type="submit" class="btn btn-success pull-left" name="form1">Update Ads</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<?php require_once('footer.php'); ?>