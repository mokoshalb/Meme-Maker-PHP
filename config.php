<?php
// Setting up the time zone
date_default_timezone_set('Africa/Lagos');

// Host Name
$dbhost = 'localhost';

// Database Name
$dbname = '';

// Database Username
$dbuser = '';

// Database Password
$dbpass = '';

// Defining base url, you must end with a slash "/"
define("BASE_URL", "http://catonite.website/mokomeme/");

// Getting Admin url
define("ADMIN_URL", BASE_URL . "admin" . "/");

//the journey into the database begins here, hop in :)
try {
	$pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch( PDOException $exception ) {
	echo "Connection error :" . $exception->getMessage();
}
?>
