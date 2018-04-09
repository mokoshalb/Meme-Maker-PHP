<?php require_once('header.php'); ?>
<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM mokomeme_page WHERE page_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
// Delete from mokomeme_page
$statement = $pdo->prepare("DELETE FROM mokomeme_page WHERE page_id=?");
$statement->execute(array($_REQUEST['id']));
header('location: page.php');
?>