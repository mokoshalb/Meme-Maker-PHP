<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
	foreach($_POST['arr_order'] as $key=>$value) {
		$statement = $pdo->prepare("UPDATE mokomeme_menu SET menu_order=? WHERE menu_id=?");
		$statement->execute(array($value,$key));
	}	
	$success_message = 'Menu Order has been changed successfully.';
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>View Menus</h1>
	</div>
	<div class="content-header-right">
		<a href="menu-add.php" class="btn btn-primary btn-sm">Add New</a>
	</div>
</section>


<section class="content">

  	<div class="row">
    	<div class="col-md-12">
	
			<p>As you will not change a menu freequently, so we did not make option to edit all items of a menu. You can only change <b>orders.</b> You can create unlimited menus (with dropdown) and delete menus when necessary. You can select a page as a menu item or can setup another menu with custom link.</p>
		

			<div class="box box-info">        
				<div class="box-body table-responsive">

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
					
					<form action="" method="post">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Menu Id</th>
								<th>Menu Name</th>
								<th>Menu Order</th>
								<th>Parent Menu Id</th>
								<th>URL</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i=0;
							$statement = $pdo->prepare("SELECT * FROM mokomeme_menu ORDER BY menu_order ASC");
							$statement->execute();
							$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
							foreach ($result as $row) {
								$i++;
								?>
								<tr>
									<td><?php echo $row['menu_id']; ?></td>
									<td><?php echo $row['menu_name']; ?></td>
									<td>
										<input type="text" name="arr_order[<?php echo $row['menu_id']; ?>]" class="form-control" value="<?php echo $row['menu_order']; ?>">
									</td>
									<td><?php echo $row['menu_parent']; ?></td>
									<td><?php echo $row['menu_url']; ?></td>
									<td>
										<a href="#" class="btn btn-danger btn-xs" data-href="menu-delete.php?id=<?php echo $row['menu_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
									</td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
					<div class="text-center">
						<input type="submit" class="btn btn-success" value="Update Order" name="form1">
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Are you sure want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>