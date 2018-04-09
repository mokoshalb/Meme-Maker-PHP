<?php
require_once('config.php');
if(!isset($_REQUEST['ids'])) {
	header('location: logout.php');
	exit;
}
$eachid = explode(',', $_REQUEST["ids"]);
foreach($eachid as $id){
// Delete each photo meme - Getting photo details to delete from folder
$statement = $pdo->prepare("SELECT * FROM mokomeme_images WHERE images_id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$photo = $row['images_title'];
	$ext = $row['images_ext'];
}
unlink('../assets/images/'.$photo.'.'.$ext);
// Delete from mokomeme_images
$statement = $pdo->prepare("DELETE FROM mokomeme_images WHERE images_id=?");
$statement->execute(array($id));
}
?>