<?php require_once('header.php'); ?>
<?php
if(!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	// Check the id is valid or not
	$statement = $pdo->prepare("SELECT * FROM mokomeme_memes WHERE memes_id=?");
	$statement->execute(array($_REQUEST['id']));
	$total = $statement->rowCount();
	if( $total == 0 ) {
		header('location: logout.php');
		exit;
	}
}
// Delete the photo - Getting photo details to delete from folder
$statement = $pdo->prepare("SELECT * FROM mokomeme_memes WHERE memes_id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$photo = $row['memes_id'];
}
unlink('../assets/memes/'.$photo.'.jpg');
// Delete from mokomeme_memes
$statement = $pdo->prepare("DELETE FROM mokomeme_memes WHERE memes_id=?");
$statement->execute(array($_REQUEST['id']));
header('location: meme.php');
?>