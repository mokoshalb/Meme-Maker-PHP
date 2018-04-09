<?php
include_once "MemeGeneratorClass.php";
$image = $_REQUEST['image'];
$obj = new MemeGenerator($image);
$preview = $_REQUEST['preview'];
$upmsg   = $_REQUEST['top'];
$downmsg = $_REQUEST['bottom'];
$obj->setUpperText($upmsg);
$obj->setLowerText($downmsg);
$downloadUrl = $obj->processImg($preview);
$encodeurlshare = rawurlencode(BASE_URL.'assets/memes/'.$downloadUrl.'.jpg');
?>
<script type="text/javascript">
function genericSocialShare(url){
    window.open(url,'sharer','toolbar=0,status=0,width=648,height=395');
    return true;
}
</script>
<div id="myModalMeme" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Download Meme</h4>
     </div>
     <div class="modal-body">
	<img src="assets/memes/<?php echo $downloadUrl; ?>.jpg" style="width:100%">
	<br><br>
<div class='item-share'>
<a class='icons-facebook dhref' href="javascript:void(0)" onclick="javascript:genericSocialShare('http://www.facebook.com/sharer.php?u=<?php echo $encodeurlshare; ?>')"><i class='fa fa-facebook'/></a>
<a class='icons-twitter dhref' href="javascript:void(0)" onclick="javascript:genericSocialShare('http://twitter.com/share?text=I created a free meme on: &url=<?php echo $downloadUrl; ?>')"><i class='fa fa-twitter'/></a>
<a class='icons-gplus dhref' href="javascript:void(0)" onclick="javascript:genericSocialShare('https://plus.google.com/share?url=<?php echo $encodeurlshare; ?>')"><i class='fa fa-google-plus'/></a>
<a class='icons-pinterest dhref' href="javascript:void(0)" onclick="javascript:genericSocialShare('http://pinterest.com/pin/create/button/?url=<?php echo BASE_URL; ?>&media=<?php echo $encodeurlshare; ?>')"><i class='fa fa-pinterest'/></a>
</div></div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="assets/memes/<?php echo $downloadUrl; ?>.jpg" download title="Download Now" class="btn btn-success">Download Now</a>
    </div>
  </div>
</div>
</div>
