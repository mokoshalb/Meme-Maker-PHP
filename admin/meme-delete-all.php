<?php
require_once('config.php');
if(!isset($_REQUEST['ids'])) {
	header('location: logout.php');
	exit;
}
$eachid = explode(',', $_REQUEST["ids"]);
foreach($eachid as $id){
// Delete each photo meme - Getting photo details to delete from folder
$statement = $pdo->prepare("SELECT * FROM mokomeme_memes WHERE memes_id=?");
$statement->execute(array($id));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	$photo = $row['memes_title'];
}
unlink('../assets/memes/'.$photo.'.jpg');
// Delete from mokomeme_memes
$statement = $pdo->prepare("DELETE FROM mokomeme_memes WHERE memes_id=?");
$statement->execute(array($id));
}
?>