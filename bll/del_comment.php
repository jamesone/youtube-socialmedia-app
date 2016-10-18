<?php
	require_once '../dal/connections/connections.php';
	require_once '../dal/display/functions.php';
	//Get posted AJAX value
	//Use posted ajax value
	if(isset($_POST['cID'])){
		$comment_id = $_POST['cID'];
		deleteComment($comment_id);
	}

	if(isset($_POST['postID'])){
		$post_id = $_POST['postID'];
		deletePost($post_id);
	}

	if(isset($_POST['user-search'])){
		$user = $_POST['user-search'];
		searchUser($user);
		// $numRecords = $stmt->rowcount();

		// if($numRecords>0){
			while($arrRows = $stmt->fetchAll(PDO::FETCH_ASSOC)){
				echo "<a href='".$arrRows['uID']."'><li>".$arrRows['name']."</li></a>";
			// }
		 // }else{
		 // 	echo "<li>No Users Found<li>";
		 }
		
		
		// exit();
		// echo "HELLO";
	}
	// $post = array_map('drop_empty', $_POST);
?>