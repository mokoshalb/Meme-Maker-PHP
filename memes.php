<?php require_once('header.php'); ?>
<!-- Page Banner Start -->
<div class="slide-single slide-single-page">
	<div class="overlay"></div>
	<div class="text text-page">
		<div class="this-item">
			<h2>Memes</h2>
		</div>
	</div>			
</div>
<!-- Page Banner End -->
<?php
//get all images from database
$statement = $pdo->prepare("SELECT * FROM mokomeme_memes ORDER BY memes_id DESC LIMIT ".$max_post);
$statement->execute();
$tot = $statement->rowCount();
?>
<div class="properties bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="row abc">
            <?php echo $ads_code; ?><br>
<?php if($tot>0):
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
$memes_id = $row['memes_id'];
$memes_title = $row['memes_title'];
?>
					<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6">	
					<div class="single-room">
		<div class="photo-col3"><img class="myImg" src="<?php echo BASE_URL; ?>assets/memes/<?php echo $memes_title; ?>.jpg" alt="<?php echo $memes_title; ?>"></div>
					</div>											
					</div>	
<?php } ?>
<?php else: ?>
					<div class="error">
					<br>
            				<?php echo $ads_code; ?>
            				<br>
						No meme is found!.
					</div>
<?php endif; ?>					
				</div>
<div class="clearfix"></div>
<div class="ajax-loading recent-loading"><img src="<?php echo BASE_URL; ?>assets/images/loading.gif" alt="loading..."></div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 view-more"><div class="tg-btnbox">
<a class="show_more_featured_posts tg-btn" href="javascript:void(0);" id="<?php echo $memes_id; ?>">View More</a>
</div></div>
			</div>
		</div>				
	</div>	
</div>
<!-- The Modal -->
<div id="myModal1" class="modal1">
<span class="close1">&times;</span>
<img class="modal1-content" id="img01">
<div id="caption"></div>
</div>
<script type="text/javascript">
function inito(){
// Get the modal
var modal = document.getElementById('myModal1');
// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementsByClassName('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
function abc(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}
for (var i = 0; i < img.length; i++) {
    img[i].addEventListener('click', abc, false);
}
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close1")[0];
// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
}
inito();
</script>
<?php require_once('footer.php'); ?>