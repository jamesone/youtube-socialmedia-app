<?php
	require ('connections/connections.php');
	require ('display/functions.php');
	// header("Location ../php/index.php");

		if(isset($_POST['user'])){
			$user = $_POST['user'];
			// $post_details = $_POST['post_details'];
			$post_embed = $_POST['video_embed'];
			// if(isset($_POST['user'])){
				insertPost($user, "null", $post_embed);
			// }
		}

		
		

?>