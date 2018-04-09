<?php require_once('header.php'); ?>
<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM mokomeme_images WHERE images_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
// Delete the photo - Getting photo details to delete from folder
$statement = $pdo->prepare("SELECT * FROM mokomeme_images WHERE images_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$photo = $row['images_title'];
	$ext = $row['images_ext'];
}
unlink('../assets/images/'.$photo.'.'.$ext);
// Delete from mokomeme_images
$statement = $pdo->prepare("DELETE FROM mokomeme_images WHERE images_id=?");
$statement->execute(array($_REQUEST['id']));
header('location: image.php');
?>