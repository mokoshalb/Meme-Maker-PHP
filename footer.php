	<!-- Footer Main Start -->
		<section class="footer-main">
			<div class="container">
				<div class="row">
				</div>
			</div>
		</section>
		<!-- Footer Main End -->		
		<!-- Footer Bottom Start -->
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-12 copyright">
						All Rights Reserved &copy; 2018
					</div>
				</div>
			</div>
		</div>
<span class="totop"><a href="javascript:void(0);"><i class="fa fa-angle-up bg-lor"></i></a></span>
	</div>
	<!-- Scripts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/modernizr.min.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/superfish.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/jquery.slicknav.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/meme.js"></script>
	<script src="<?php echo BASE_URL; ?>assets/js/custom.js"></script>
	<?php require 'uploader.php'; ?>
	<script type="text/javascript">
    	jQuery('.upload-button').click(function(){
        	jQuery('#photoimg_featured').click();
    	});
	function uploadnew(val){
	var base_url  = '<?php echo BASE_URL; ?>';
	var image_url = base_url+'assets/images/'+val;
	$('#memeCanvas').find('.img-responsive').attr('src', image_url);
        $('#memeCanvas').find('.img-responsive').attr('rel', image_url);
        $('input[name="secretimage"]').attr('value', image_url);
        $('.prememe').prepend('<div class="col-lg-3 col-md-3 col-sm-3 col-xs-6"><a href="javascript:void(0);" class="thumbnail"><img src="'+image_url+'" alt="Image" class="img-responsive lime"></a></div>');
        }
        $(document).on('hidden.bs.modal','#myModal', function () {
	$('#myModal').remove();
	});
	$(document).on('hidden.bs.modal','#myModalMeme', function () {
	$('#myModalMeme').remove();
	});
        </script>
</body>
</html>
