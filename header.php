<?php
ob_start();
session_start();
include("config.php");
$error_message = '';
$success_message = '';
// Getting the basic data for the website from database
$statement = $pdo->prepare("SELECT * FROM mokomeme_settings WHERE id=1");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row)
{
	$logo = $row['logo'];
	$favicon = $row['favicon'];
	$receive_email = $row['receive_email'];
	$send_email = $row['send_email'];
	$max_post = $row['max_images'];
	$meta_title_home = $row['meta_title_home'];
	$meta_keyword_home = $row['meta_keyword_home'];
	$meta_description_home = $row['meta_description_home'];
}
$statement = $pdo->prepare("SELECT * FROM mokomeme_ads");
$statement->execute();
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
	$ads_code = $row['ads_code'];
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
	<!-- Meta Tags -->
	<meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    	<title><?php echo $meta_title_home; ?></title>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>

	<!-- Showing the SEO related meta tags data -->
	<meta name="description" content="<?php echo $meta_description_home; ?>">
	<meta name="keywords" content="<?php echo $meta_keyword_home; ?>">
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>assets/images/<?php echo $favicon; ?>">	
	
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/superfish.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/slicknav.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/responsive.css">
	<link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/custom.css">
</head>
<body>
	<div class="page-wrapper">
		<!-- Header Start -->
		<header>
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3 logo">
						<a href="<?php echo BASE_URL; ?>"><img src="<?php echo BASE_URL; ?>assets/images/<?php echo $logo; ?>" alt=""></a>
					</div>
					<div class="col-md-9 col-sm-9 nav-wrapper">

						<!-- Nav Start -->
						<nav>
							<ul class="sf-menu" id="menu">
							<li><a href="<?php echo BASE_URL; ?>memes.php">Memes</a></li>
								<?php
								// Showing the menu dynamically from the database
								$statement = $pdo->prepare("SELECT * FROM mokomeme_menu ORDER BY menu_order ASC");
								$statement->execute();
								$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
								foreach ($result as $row) 
								{
									echo '<li>';
									if($row['menu_parent']==0)
									{
										if($row['menu_type']=='Page')
										{
											echo '<a href="'.BASE_URL.'page/'.$row['category_or_page_slug'].'">';
										}
										if($row['menu_type']=='Other')
										{
											echo '<a href="'.$row['menu_url'].'">';
										}										
										echo $row['menu_name'];
										echo '</a>';
									}

									$statement1 = $pdo->prepare("SELECT * FROM mokomeme_menu WHERE menu_parent=?");
									$statement1->execute(array($row['menu_id']));
									$total = $statement1->rowCount();
									if($total)
									{
										echo '<ul>';
										$result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);							
										foreach ($result1 as $row1) 
										{
											echo '<li>';
											if($row1['menu_type']=='Page')
											{
												echo '<a href="'.BASE_URL.'page/'.$row1['category_or_page_slug'].'">';
											}
											if($row1['menu_type']=='Other')
											{
												echo '<a href="'.$row1['menu_url'].'">';
											}											
											echo $row1['menu_name'];
											echo '</a>';
											echo '</li>';
										}
										echo '</ul>';
									}
									echo '</li>';
								}
								?>
							</ul>
						</nav>
						<!-- Nav End -->

					</div>
				</div>
			</div>
		</header>
		<!-- Header End -->