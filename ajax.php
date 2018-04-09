<?php
require 'config.php';
if(isset($_POST["id"]) && !empty($_POST["id"])){
//count all rows except already displayed
$showLimit = 10;
$statement = $pdo->prepare("SELECT * FROM mokomeme_memes WHERE (memes_id < ?) ORDER BY memes_id DESC LIMIT ". $showLimit);
$statement->execute(array($_POST['id']));
$total_recent_item1 = $statement->rowCount();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
//getting category posts from Database
$memes_id = $row['memes_id'];
$memes_title = $row['memes_title'];
?>
				<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">	
					<div class="single-room">
		<div class="photo-col3"><img class="myImg" src="<?php echo BASE_URL; ?>assets/memes/<?php echo $memes_title; ?>.jpg" alt="<?php echo $memes_title; ?>"></div>
					</div>											
					</div>	
<?php } } ?>
<?php if($total_recent_item1 > 0){ ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 view-more" id="<?php echo $memes_id; ?>"><div class="tg-btnbox">
<a class="show_more_featured_posts tg-btn" href="javascript:void(0);" id="<?php echo $memes_id; ?>">View More</a>
</div></div>
<?php } ?>