<div class="channel-categories">
	<h2>Categories</h2>
	<ul>
		<?php
		$statement = $pdo->prepare("SELECT * FROM tbl_category WHERE status=?");
		$statement->execute(array('Active'));
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
		foreach ($result as $row) {
			?><li><a href="<?php echo BASE_URL; ?>category/<?php echo $row['category_slug']; ?>"><?php echo $row['category_name']; ?></a></li><?php
		}
		?>
	</ul>
</div>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_advertisement_sidebar");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) {
	?>
	<div class="sidebar-adv">
		<?php if($row['adv_url']==''): ?>
			<img src="<?php echo BASE_URL; ?>assets/uploads/<?php echo $row['adv_photo']; ?>" alt="advertisement">
		<?php else: ?>
			<a href="<?php echo $row['adv_url']; ?>"><img src="<?php echo BASE_URL; ?>assets/uploads/<?php echo $row['adv_photo']; ?>" alt="advertisement"></a>
		<?php endif; ?>
			
	</div>
	<?php
}
?>

