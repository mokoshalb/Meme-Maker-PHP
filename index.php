<?php require_once('header.php'); ?>
<style>
			html {
				-webkit-transition: background-color 1s;
				transition: background-color 1s;
			}
			.loading { min-height: 100%; position: fixed;}
			html.loading {
				background: #333 url('https://code.jquery.com/mobile/1.3.1/images/ajax-loader.gif') no-repeat 50% 50%;
				-webkit-transition: background-color 0;
				transition: background-color 0;
				height: 100%;
    				width: 100%;
			}
			body {
				-webkit-transition: opacity .1s ease-in;
				transition: opacity .1s ease-in;
			}
			html.loading body {
				opacity: 0;
				-webkit-transition: opacity 0;
				transition: opacity 0;
			}
			button {
				background: #00A3FF;
				color: white;
				padding: 0.2em 0.5em;
				font-size: 1.5em;
			}
</style>
<div class="properties bg-gray">
	<div class="container">
    <div class="row">
        <div class="col-sm-12">
        <?php echo $ads_code; ?>
        <br>
        <div class="well">
            <div id="memeCanvas">
                <div class="row">
                    <div class="col-md-8">
                        <img class="img-responsive" src="assets/images/bird1.jpg" alt="" rel="assets/images/bird1.jpg">
                    </div>
                    <!-- end of div -->
                    <div class="col-md-4">
                        <form>
                            <div class="form-group">
                                <label for="toptext">Top Text</label>
                                <input type="text" name="toptext" id="toptext" class="form-control">
                            </div>
                            <!-- end of div -->

                            <div class="form-group">
                                <label for="bottomtext">Bottom Text</label>
                                <input type="text" name="bottomtext" id="bottomtext" class="form-control">
                            </div>
                            <!-- end of div -->

                            <div class="form-group">
                                <input type="submit" value="Meme It!" class="btn btn-success form-control meme">
                            </div>
                            <!-- end of div -->
                            <input type="hidden" name="secretimage" value="assets/images/bird1.jpg">
                        </form>
                        <input type="button" value="Upload Your Image" class="btn btn-primary form-control">
                        <br><br>
                        <img class="upload-button" id="featured-img" src="<?php echo BASE_URL.'assets/images/upload.png'; ?>">
                    </div>
                    <!-- end of column -->
                </div>
                <!-- end of div -->
            </div></div><br>
            <?php echo $ads_code; ?>
            <!-- end of div with id memeCanvas -->
            <br><br>
            <div class="well">
                    <!-- Carousel items -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row prememe">
<?php
//get all images from database
$statement = $pdo->prepare("SELECT * FROM mokomeme_images ORDER BY images_id DESC");
$statement->execute();
$total_recent_item = $statement->rowCount();
if($total_recent_item>0): 
$i=0;
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
//getting each image details
$i++;
if($i>$max_post) {
break;
}
$image_id = $row['images_title'];
$image_ext = $row['images_ext'];
?>
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 img-list">
<a href="javascript:void(0);" class="thumbnail"><img src="assets/images/<?php echo $image_id.'.'.$image_ext; ?>" alt="Image" class="img-responsive lime"></a>
</div>
<?php } ?>                          
                            </div>
                            <!--/row-->
                        </div>
                        <!--/item-->
                    </div>
                </div>
                <!--/myCarousel-->
            <!--/well-->
            <br>
            <?php echo $ads_code; ?>
        </div>
    </div>
</div>
<!-- end of container -->
<?php endif; ?>
</div>
<?php require_once('footer.php'); ?>