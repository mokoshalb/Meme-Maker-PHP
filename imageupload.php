<?php
$status = array('error'=>1,'name'=>'','errorm'=>'');
$path = $_FILES['photoimg']['name'];
$path_tmp = $_FILES['photoimg']['tmp_name'];
if($path == '') {
	$status['error']  = 1;
        $status['errorm'] = 'You must select a photo';
        echo json_encode($status);
 	} else {
    		$ext = pathinfo( $path, PATHINFO_EXTENSION );
    		if($ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif') {
    		$status['error'] = 1;
        	$status['errorm'] = 'You have to upload a jpg, jpeg, gif or png file';
        	echo json_encode($status);
    		} else {
    			$status['error'] = 0;
    			$id = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
    			$imageid = str_shuffle($id);
    			$imageid = substr($imageid,0,10);
    			require "config.php";
		        // saving into the database
			$statement = $pdo->prepare("INSERT INTO mokomeme_images (images_title, images_ext) VALUES (?,?)");
			$statement->execute(array($imageid, $ext));
			//$last_id = $pdo->lastInsertId();
			// uploading the photo into the main location and giving it a final name
    			$status['name'] = $imageid.'.'.$ext;
            		move_uploaded_file( $path_tmp, 'assets/images/'.$status['name'] );
            		echo json_encode($status);
            	}
	}
?>