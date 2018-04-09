<?php require_once('header.php'); ?>

<?php
// Preventing the direct access of this page.
if(!isset($_REQUEST['slug']))
{
	header('location: index.php');
	exit;
}
else
{
	// Check the page slug is valid or not.
	$statement = $pdo->prepare("SELECT * FROM mokomeme_page WHERE page_slug=?");
	$statement->execute(array($_REQUEST['slug']));
	$total = $statement->rowCount();
	if( $total == 0 )
	{
		header('location: index.php');
		exit;
	}
}

// Getting the detailed data of a page from page slug
$statement = $pdo->prepare("SELECT * FROM mokomeme_page WHERE page_slug=?");
$statement->execute(array($_REQUEST['slug']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
foreach ($result as $row) 
{
	$page_name    = $row['page_name'];
	$page_slug    = $row['page_slug'];
	$page_content = $row['page_content'];
	$page_layout  = $row['page_layout'];
}
?>		
<?php if($page_layout == 'Full Width'): ?>
<div class="slide-single slide-single-page">
	<div class="overlay"></div>
	<div class="text text-page">
		<div class="this-item">
			<h2><?php echo $page_name; ?></h2>
		</div>
	</div>
</div>
<div class="single-channel">			
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">															
				<div class="channel-text">
					<?php echo $page_content; ?>
				</div>
				<div class="gap-small"></div>
			</div>
		</div>											
	</div>											
</div>
<?php endif; ?>
<?php if($page_layout == 'Contact Us'): ?>
<div class="slide-single slide-single-page">
	<div class="overlay"></div>
	<div class="text text-page">
		<div class="this-item">
			<h2><?php echo $page_name; ?></h2>
		</div>
	</div>			
</div>
<section class="contact">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="heading-normal">
					<h2>Contact Form</h2>
					<p>Fill up the form below to contact us and send us an email</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7">
<?php
// After form submit checking everything for email sending
if(isset($_POST['form_contact']))
{
$error_message = '';
$success_message = '';
$valid = 1;
    if(empty($_POST['visitor_name'])){
        $valid = 0;
        $error_message .= 'Please enter your name.<br>';
    }
    if(empty($_POST['visitor_phone'])){
        $valid = 0;
        $error_message .= 'Please enter your phone number.<br>';
    }
    if(empty($_POST['visitor_email'])){
        $valid = 0;
        $error_message .= 'Please enter your email address.<br>';
    } else {
    	// Email validation check
        if(!filter_var($_POST['visitor_email'], FILTER_VALIDATE_EMAIL)){
            $valid = 0;
            $error_message .= 'Please enter a valid email address.<br>';
        }
    }
    if(empty($_POST['visitor_comment'])){
        $valid = 0;
        $error_message .= 'Please enter your comment.<br>';
    }
if($valid == 1){
        // sending email
        $subject = "Contact Form Message";
		$message = '
<html><body>
<table>
<tr>
<td>Name</td>
<td>'.$_POST['visitor_name'].'</td>
</tr>
<tr>
<td>Email</td>
<td>'.$_POST['visitor_email'].'</td>
</tr>
<tr>
<td>Phone</td>
<td>'.$_POST['visitor_phone'].'</td>
</tr>
<tr>
<td>Comment</td>
<td>'.nl2br($_POST['visitor_comment']).'</td>
</tr>
</table>
</body></html>
';
$visitor_email = $_POST['visitor_email'];
		$headers = 'From: ' . $send_email . "\r\n" .
				   'Reply-To: ' . $visitor_email . "\r\n" .
				   'X-Mailer: PHP/' . phpversion() . "\r\n" . 
				   "MIME-Version: 1.0\r\n" . 
				   "Content-Type: text/html; charset=ISO-8859-1\r\n";
		// Sending email to admin				   
        mail($receive_email, $subject, $message, $headers); 
        $success_message = "Message sent successfully!";
    }
}
?>		
				<?php
				if(!empty($error_message))
				{
					echo '<div class="error">';
					echo $error_message;
					echo '</div>';
				} 
				if(!empty($success_message))
				{
					echo '<div class="success">';
					echo $success_message;
					echo '</div>';
				}
				?>			
				<form action="" class="form-horizontal cform-1" method="post">
					<div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" name="visitor_name" class="form-control" placeholder="Name">
                        </div>
                    </div>
					<div class="form-group">
                        <div class="col-sm-12">
                            <input type="email" name="visitor_email" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input type="text" name="visitor_phone" class="form-control" placeholder="Phone Number">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" name="visitor_comment" cols="30" rows="10" placeholder="Message"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
	                    <div class="col-sm-12">
	                        <input type="submit" value="Send Message" class="btn btn-success" name="form_contact">
	                    </div>
	                </div>
				</form>
			</div>
			<div class="col-md-5">
				<div class="google-map">
					
				</div>
			</div>
		</div>		
	</div>
</section>
<?php endif; ?>
<?php require_once('footer.php'); ?>