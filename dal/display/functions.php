<?php
session_start();
	function checkSession(){
		if(isset($_SESSION['logged'])){
			/* 
				Set the session variables
			*/
			if(!isset($_COOKIE['loggedIn'])){
	        	$user_logged = validate_key($_SESSION['logged']);
		        // print_r_nice($user_logged);
		        $_SESSION['id'] = $user_logged['uID'];
		        $_SESSION['name'] = $user_logged['name'];
		        $_SESSION['avatar'] = $user_logged['avatar'];
		        setcookie("loggedIn", 1);
	        }
	        // $user_Id = $_SESSION['id'];
	        return;
     	}
     	else{
     		return 0;
     	}		
	}

/*
	All functions will be put and included in this file
*/
include ("../dal/connections/connections.php");
include ("../dal/auth.php");


//This will get videos that the user ID has not seen
	function showVideos($randVideo, $category, $user){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)

		if($category == "1" || $category == "none"){
			$sqlStr = "SELECT * from videos where vId NOT IN (select vId from userLikedVideos where uID = ".$user.");";
			// $sqlStr = "SELECT * from videos where vId NOT IN (select vId from userLikedVideos where uID = ".$user.")  ORDER BY RAND();";
		}
		else{
			$sqlStr = "SELECT * FROM videos where vId = ".$randVideo." and vCat = ".$category;
		}
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt->rowcount() == 0){
				$stmt = $dbConnection->query("SELECT * FROM videos ORDER BY RAND() LIMIT 1");
				// echo "IN IF<br />";
			}
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		$numRecords = $stmt->rowcount();
		$arrValues = $stmt->fetch(PDO::FETCH_ASSOC);
		return array($arrValues['vEmbed'], $arrValues['likes'],$arrValues['dislikes']);

		//Close the databaase connection
		$dbConnection = NULL;
	}

//Record the likes for the particular video and user.
	function recordLikes($vote, $uID, $vId){
		global $numRecords, $dbConnection, $stmt,$stmtt, $sqlUpdate;
		connect(); //Run connect function (../connections/connections.php)

		//This is used so we can get the current likes for the particular video.
		//SQL Query - results sorted by specified column
		$sqlStr = "SELECT * FROM videos where vId = ".$vId;
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);

			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		//Here we are tallying up the particular videos likes and dislikes
		$arrVal = $stmt->fetch(PDO::FETCH_ASSOC);
		if($vote){
			$sqlStr = "UPDATE videos SET likes = ".($arrVal['likes']+=1).", dislikes = ".$arrVal['dislikes'];
			$sqlStr .= " WHERE vId = $vId";
			// UPDATE videos SET likes = 40, dislikes = 10  WHERE vId = 5
		}
		else{
			$sqlStr = "UPDATE videos SET likes = ".$arrVal['likes'].", dislikes = ".($arrVal['dislikes']+=1);
			$sqlStr .= " WHERE vId = ".$vId;
			// exit();

		}
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);

			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured ONE: ".$error->getMessage();
		}

######################################################################################################


		//Select  so we can get the current likes/dislikes for the particular videoID and uID
		$sqlStr = "select * from userLikedVideos where uID = ".$uID." and vId = ".$vId;

		//Here I will grab whether the user liked or disliked the particular video
		//This data will be used later to find videos based on there most liked.
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			$arrVal = $stmt->fetch(PDO::FETCH_ASSOC);
			if($stmt->rowcount() == 0){
				if($vote){
					$sqlStr = "INSERT INTO userLikedVideos VALUES (".$uID.", ".$vId.", 1, 1, 0)";
				}
				else{
					$sqlStr = "INSERT INTO userLikedVideos VALUES (".$uID.", ".$vId.", 0, 0, 0)";
				}
				$stmt = $dbConnection->query($sqlStr);
			}
			else{
				// $stmt = $dbConnection->query("select (likes, dislikes) from userLikedVideos where uID = ".$uID." and ".);
				if($vote){
					// exit()
					$sqlStr = "UPDATE userLikedVideos SET liked = ".($arrVal['liked']+=1).", dislikes = ".$arrVal['dislikes']; 
					$sqlStr .= " where uID = ".$uID. " and vId = ".$vId;
				}
				else{
					$sqlStr = "UPDATE userLikedVideos SET liked = ".$arrVal['liked'].", dislikes = ".($arrVal['dislikes']+=1);
					$sqlStr .= " where uID = ".$uID. " and vId = ".$vId;
				}
				$stmt = $dbConnection->query($sqlStr);
			}
			if($stmt === false)
			{
				die("Error executing the query TWO: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		// $numRecords = $stmt->rowcount();
		$stmt = "";
		$dbConnection = NULL;
		// $arrValues = $stmt->fetch(PDO::FETCH_ASSOC);
		// echo $arrValues['vEmbed'];
}

######################################################################################################

//Show a particular category - Value is passed by a checkbox array
function showCategory($categories, $filter,$user){
	global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)

		//Change the vidNumber everytimme the user clicks like/dislike
		if(isset($_GET['vidNumber'])){$offset = $_GET["vidNumber"];}
		$numPerPage = 1;


				if($filter==1){
					// exit();
					//Default All
					if(implode("", $categories) == "all" || implode("", $categories) == "All"){
						$sqlStr = "SELECT * FROM videos ORDER BY likes DESC LIMIT " . $numPerPage . " OFFSET " . $offset;
					}
					else{
						$sqlStr = "SELECT * FROM videos WHERE vCat like '%".implode("%' OR vCat like '%", $categories)."%'";
						$sqlStr .= " ORDER BY likes DESC LIMIT " . $numPerPage . " OFFSET " . $offset;
					}
				}
				else if($filter==0){
					// exit();
					if(implode("", $categories) == "all" || implode("", $categories) == "All" ){
						$sqlStr = "SELECT * FROM videos ORDER BY dislikes ASC LIMIT " . $numPerPage . " OFFSET " . $offset;
					}else{
						$sqlStr = "SELECT * FROM videos WHERE vCat like '%".implode("%' OR vCat like '%", $categories)."%'";
						$sqlStr .= " ORDER BY dislikes ASC LIMIT " . $numPerPage . " OFFSET " . $offset;
					}
				}
				else if($filter == 3){
					// exit();
					//Unseen videos filter.
					if(implode("", $categories) == "all" || implode("", $categories) == "All" ){
						$sqlStr = "SELECT * from videos where vId NOT IN (select vId from userLikedVideos where uID = ".$user.")";
					}else{
						$sqlStr = "SELECT * from videos where vId NOT IN (select vId from userLikedVideos where uID = ".$user.")";
						$sqlStr .= " and vCat like '%".implode("%' OR vCat like '%", $categories)."%'";
					}
				}
				else if($filter == 4){
					$sqlStr = "SELECT * FROM videos where vID = $categories";
				}
				else{
					// exit();
					if(implode("", $categories) == "all" || implode("", $categories) == "All"){
						$sqlStr = "SELECT * FROM videos ORDER BY likes ASC LIMIT " . $numPerPage . " OFFSET " . $offset;
					}else{
						$sqlStr = "SELECT * FROM videos WHERE vCat like '%".implode("%' OR vCat like '%", $categories)."%'";
						$sqlStr .= "LIMIT " . $numPerPage . " OFFSET " . $offset;
					}

				}
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt->rowcount() == 0){
				//If there is no results found - Randomly find videos.
				$stmt = $dbConnection->query("SELECT * FROM videos ORDER BY RAND() LIMIT 1");
				// echo "IN IF<br />";
			}
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		$numRecords = $stmt->rowcount();
		
			$arrValues = $stmt->fetch(PDO::FETCH_ASSOC);	
			return array($arrValues['vEmbed'], $arrValues['likes'],$arrValues['dislikes'], $numRecords, $arrValues['vCat'], $arrValues['vId']);		

		//Close the databaase connection
		$dbConnection = NULL;
	}


##############################################################################################################


########################### PLAYLIST FUNCTIONS BELOW ###################################

	function showUserPlaylists($user){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)
		$sqlStr = "select * from playlists where uID = ".$user;
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt->rowcount() == 0){
				$stmt = $dbConnection->query("SELECT * FROM videos ORDER BY RAND() LIMIT 1");
				// echo "IN IF<br />";
			}
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
		$numRecords = $stmt->rowcount();
		if($stmt->rowCount() == 0){
			return 0;
		}
		else if($stmt == false){
			die("An error has occured, sorry");
		}
		// $arrValues = $stmt->fetch(PDO::FETCH_ASSOC);

		// echo "Number of records found: ".$numRecords." -";
		// echo $arrValues['vEmbed'];
		// return array($arrValues['vEmbed'], $arrValues['likes'],$arrValues['dislikes'], $numRecords, $arrValues['vCat']);

		//Close the databaase connection
		$dbConnection = NULL;
	}

	function insertPlaylistVideo($playlistNum, $vId){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)
		// insert into playlist_videos (pId, vId) VALUES(1, 4) where vId not in (select pId, vId from playlist_videos where pId = 1);
		$sqlStr = "SELECT pID, vId FROM playlist_videos WHERE pID = ".$playlistNum." and vId = ".$vId;

		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt->rowcount() == 0){
				$sqlStr = "INSERT INTO playlist_videos (pId, vId) VALUES ('".$playlistNum."', '".$vId."')";
				$dbConnection->query($sqlStr);
		
			}
			else{
				echo "This already exists in this playlist!";
				// exit();
			}
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
		//Close the databaase connection
		$dbConnection = NULL;
	}

//USE THIS TO DISPLAY PLAYLIST TO USER ON THERE OWN PAGE.
	function showPlaylist($uID){
		//Add validation to make sure the pID in the button hasn't been tampered with and is valid.
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)

		if($uID == "global"){
			$sqlStr = "SELECT vids.*, playlists.* FROM videos";
			$sqlStr .= " AS vids JOIN playlist_videos AS playlist_videos ON vids.vId = playlist_videos.vId";
			$sqlStr .= " JOIN playlists ON playlist_videos.pId = playlists.pID ORDER BY playlists.likes DESC";
		}
		else{
			//This will grab all the videos from a particular playlist - 
			//SELECT vids.*, playlists.pName as `playlist_title` FROM videos AS vids JOIN playlist_videos AS playlist_videos ON vids.vId = playlist_videos.vId JOIN playlists ON playlist_videos.pId = playlists.pID WHERE playlists.uID = 2	
			$sqlStr = "SELECT vids.*, playlists.* FROM videos";
			$sqlStr .= " AS vids JOIN playlist_videos AS playlist_videos ON vids.vId = playlist_videos.vId";
			$sqlStr .= " JOIN playlists ON playlist_videos.pId = playlists.pID WHERE playlists.uID = ".$uID;
		}
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			// if($stmt->rowcount() == 0){
			// 	return 0;
			// }
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		$numRecords = $stmt->rowcount();

		// $arrValues = $stmt->fetch(PDO::FETCH_ASSOC);

		// // echo "Number of records found: ".$numRecords." -";
		// // echo $arrValues['vEmbed'];
		// return array($arrValues['vEmbed'], $arrValues['likes'],$arrValues['dislikes'], $numRecords, $arrValues['vCat']);

		//Close the databaase connection
		$dbConnection = NULL;
	}


	function recordPlayLikes($pID, $vote){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)
		$sqlStr = "select * from playlists where pID = ".$pID;
			//Run Query
			try
			{
				$stmt = $dbConnection->query($sqlStr);
				if($stmt === false)
				{
					die("Error executing the query: $sqlStr");
				}
			}
			catch(PDOException $error)
			{
				//Display error message if applicable
				echo "An error occured: ".$error->getMessage();
			}
		$arrVal = $stmt->fetch(PDO::FETCH_ASSOC);

		if($vote){
			$sqlStr = "UPDATE playlists SET likes = ".($arrVal['likes']+=1).", dislikes = ".$arrVal['dislikes']; 
			$sqlStr .= " where pID = ".$pID;
		}
		else{
			$sqlStr = "UPDATE playlists SET likes = ".$arrVal['likes'].", dislikes = ".($arrVal['dislikes']+=1); 
			$sqlStr .= " where pID = ".$pID;	
		}
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		$numRecords = $stmt->rowcount();

		//Close the databaase connection
		$dbConnection = NULL;
	}

############################################################################################################

########################### COMMENTS FUNCTIONS BELOW ######################################################

	function showComments($videoId, $userId){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)

		//This gets the users of each comment aswell!
		$sqlStr = "SELECT comments.*, videos.vId, user.* FROM video_comments AS comments JOIN user ON comments.uID = user.uID JOIN videos ON comments.vId = videos.vId WHERE videos.vId = ".$videoId ." ORDER BY comment_date DESC";
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt->rowcount() == 0){
				echo "No comments found";
			}
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		$numRecords = $stmt->rowcount();
		while($arrValues = $stmt->fetch(PDO::FETCH_ASSOC)){
			echo "<div id='comment".$arrValues['cID']."' class='comment-wrap'>";
				//Name of commenter + date time.
				echo "<div class='comment-header'>";
					echo "<img class='prof-img' src='./../assets/uploads/user/".$arrValues['avatar']."' alt='profile_pic' />";
					echo "<span>".$arrValues['name']."</span>";
				echo "</div>";
				//The comment
				echo "<div class='comment-content'>";
					echo $arrValues['comment_data'];
				echo "</div>";
				echo "<div class='comment-footer'>";
				//Only show delete button for logged in users (For now $staticTestUser)
				if($userId == $arrValues['uID']){
					echo "<a onclick='delpost(".$arrValues['cID'].");'>Delete comment</a>";
				}
				echo "</div>";
				//When ready add the reply to comment (comment-footer) here
			echo "</div>";
		}
		//Close the databaase connection
		$dbConnection = NULL;
	}
	function insertComment($uId, $vId, $comment){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)

		//This gets the users of each comment aswell!
		//$sqlStr = "SELECT comments.*, videos.vId, user.* FROM video_comments AS comments JOIN user ON comments.uID = user.uID JOIN videos ON comments.vId = videos.vId WHERE videos.vId = ".$videoId;
		$sqlStr = "INSERT INTO video_comments (uID, vId, comment_data, comment_date) VALUES(".$uId.", ".$vId.", '".$comment."', now())";
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt->rowcount() == 0){
				echo "No comments found";
			}
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		//Close the databaase connection
		$dbConnection = NULL;
	}

######################################################################################################

	function deleteComment($comment_id){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)

		$sqlStr = "DELETE FROM video_comments WHERE cID=".$comment_id;
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		//Close the databaase connection
		$dbConnection = NULL;
	}

######################################################################################################
	
	function insertPost($uId, $pData, $pEmbed){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)
		
		//This gets the users of each comment aswell!
		//$sqlStr = "SELECT comments.*, videos.vId, user.* FROM video_comments AS comments JOIN user ON comments.uID = user.uID JOIN videos ON comments.vId = videos.vId WHERE videos.vId = ".$videoId;
		if($pEmbed == 'embed'){
			$sqlStr = "INSERT INTO user_post (uID, post_data, post_time) VALUES(".$uId.", '".$pData."', now());";		
		}
		else{
			$sqlStr = "INSERT INTO user_post (uID, post_data, post_time, post_embed) VALUES(".$uId.", '".$pData."', now(), '".$pEmbed."')";
		}
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		//Close the databaase connection
		$dbConnection = NULL;
	}

	function showPost($uID){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)

		//This gets the users of each comment aswell!
		//$sqlStr = "SELECT comments.*, videos.vId, user.* FROM video_comments AS comments JOIN user ON comments.uID = user.uID JOIN videos ON comments.vId = videos.vId WHERE videos.vId = ".$videoId;
		// $sqlStr = "INSERT INTO user_post (uID, post_data, post_time) VALUES(".$uId.", '".$pData."', now())";
		// $sqlStr = "select * from user_post where uID = ".$uID." ORDER BY post_time DESC";
		$sqlStr = "SELECT user_post.*, user.name, user.avatar FROM user_post JOIN user ON user_post.uID = user.uID WHERE user_post.uID = ".$uID. " ORDER BY post_time DESC";
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt->rowCount() == 0){
				echo "<div class='none-found'>This user has no made no posts</div>";
			}
			else if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
		$numRecords = $stmt->rowcount();

		
		//Close the databaase connection
		$dbConnection = NULL;
	}

	function deletePost($postID){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)

		$sqlStr = "DELETE FROM user_post WHERE postID= ".$postID;
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt->rowcount() == 0){
				echo "No comments found";
			}
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		//Close the databaase connection
		$dbConnection = NULL;
	}

######################################################################################################
	function searchUser($user){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)

		$sqlStr = "select * from user where name like %".$user."%";
		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt->rowcount() == 0){
				echo "No user found";
			}
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
		
		// foreach($rows as $key => $arrRows){

		// }
		// return $rows;
		//Close the databaase connection
		$dbConnection = NULL;
	}

	function userProfile($user){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)
		if($user == ""){
			echo "No user found";
		}else{
			$sqlStr = "select * from user where uID = ".$user;
		
			//Run Query
			try
			{
				$stmt = $dbConnection->query($sqlStr);
				if($stmt->rowcount() == 0){
					// echo "No user found";
					die("No user found");
				}
				if($stmt === false)
				{
					die("Error executing the query: $sqlStr");
				}
			}
			catch(PDOException $error)
			{
				//Display error message if applicable
				echo "An error occured: ".$error->getMessage();
			}
		}
		
		// foreach($rows as $key => $arrRows){

		// }
		// return $rows;
		//Close the databaase connection
		$dbConnection = NULL;
	}

	//INSERT FOLLOWER
	function insertFollower($sesUser, $user){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)
		//$sqlStr = "SELECT pID, vId FROM playlist_videos WHERE pID = ".$playlistNum." and vId = ".$vId;

		if($user == "" || $sesUser == ""){
			echo "We've encountered a problem! No user has been found (insertFollower)";
		}else{	
			$sqlStr = "INSERT INTO followers (uID, fID) VALUES (".$sesUser.", ".$user.")";
		
			//Run Query
			try
			{
				$dbConnection->query($sqlStr);

				if($stmt === false)
				{
					die("Error executing the query: $sqlStr");
				}
			}
			catch(PDOException $error)
			{
				//Display error message if applicable
				echo "An error occured: ".$error->getMessage();
			}
			// return false;
		}

		//Close the databaase connection
		$dbConnection = NULL;
	}

	//Show amount of followers
	function showFollowers($uID){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)
		$sqlStr = 'select count(*) as followers from followers where fID = '.$uID;
		//Run Query
			try
			{
				$stmt = $dbConnection->query($sqlStr);
				if($stmt->rowcount() == 0){
					echo "No user found";
					// die("No user found");
				}
				if($stmt === false)
				{
					die("Error executing the query: $sqlStr");
				}
			}
			catch(PDOException $error)
			{
				//Display error message if applicable
				echo "An error occured: ".$error->getMessage();
			}
			// echo $stmt;
			$amountFollowers = $stmt->fetch(PDO::FETCH_ASSOC);
			// echo implode(" ",$amountFollowers);
			// print_r($amountFollowers);

			echo $amountFollowers['followers'];
			
		$dbConnection = NULL;
	}

######################################################################################################
	
	function youtube_title($embed) {
		// $id = 'YOUTUBE_ID';
		$DEVELOPER_KEY = 'AIzaSyA6jJD4brngNsLvKbblig2bBhuF9uGwjW4';
		// returns a single line of JSON that contains the video title. Not a giant request.
		$videoTitle = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$embed."&key=".$DEVELOPER_KEY."&fields=items(id,snippet(title,thumbnails),statistics)&part=snippet,statistics");
		// despite @ suppress, it will be false if it fails
		if ($videoTitle) {
			$json = json_decode($videoTitle, true);
			$title = $json['items'][0]['snippet']['title'];
			$thumbnail = "<img src='".$json['items'][0]['snippet']['thumbnails']['default']['url']."' />";

			// print_r($json);
			return array($title, $thumbnail);
		} else {
			 return false;
		}
	}
	


	//FUTURE SQL QUERIES:
	//This will grab all the comments from a particular user - This can be used on the users PROFILE page for MOST RECENT COMMENTS or ALL COMMENTS
	//SELECT comments.*, user.name FROM video_comments AS comments JOIN user ON comments.uID = user.uID WHERE user.uID = 1

	//This sql statement will grab all comments from the particular vId, it will grab the comment, uID, and name of commenter
	//SELECT comments.*, user.name FROM video_comments AS comments JOIN user ON comments.uID = user.uID JOIN videos WHERE videos.vId = 1


function print_r_nice($array, $exit = true){
	echo "<pre>".print_r($array, true)."</pre>";
	if($exit) exit;
}

// ?>