<?php require_once('header.php'); ?>

<section class="content-header">
  <h1>Dashboard</h1>
</section>

<?php 
$statement = $pdo->prepare("SELECT * FROM mokomeme_images");
$statement->execute();
$total_images = $statement->rowCount();

$statement = $pdo->prepare("SELECT * FROM mokomeme_memes");
$statement->execute();
$total_memes = $statement->rowCount();
?>

<section class="content">

  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-picture-o"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Images</span>
          <span class="info-box-number"><?php echo $total_images; ?></span>
        </div>
      </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-tasks"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Memes</span>
          <span class="info-box-number"><?php echo $total_memes; ?></span>
        </div>
      </div>
    </div>
  </div>


</section>

<?php require_once('footer.php'); ?>