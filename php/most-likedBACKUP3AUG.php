<?php
//BACKUP OF showCategory() function (videos)
//Show a particular category - Value is passed by a checkbox array
// function showCategory($categories, $filter,$user){
// 	global $numRecords, $dbConnection, $stmt;
// 		connect(); //Run connect function (../connections/connections.php)

// 		//Change the vidNumber everytimme the user clicks like/dislike
// 		$offset = $_GET["vidNumber"];
// 		$numPerPage = 1;


// 				if($filter==1){
// 					// exit();
// 					//Default All
// 					if(implode("", $categories) == "all" || implode("", $categories) == "All"){
// 						$sqlStr = "SELECT * FROM videos ORDER BY likes DESC LIMIT " . $numPerPage . " OFFSET " . $offset;
// 					}
// 					else{
// 						$sqlStr = "SELECT * FROM videos WHERE vCat like '%".implode("%' OR vCat like '%", $categories)."%'";
// 						$sqlStr .= " ORDER BY likes DESC LIMIT " . $numPerPage . " OFFSET " . $offset;
// 					}
// 				}
// 				else if($filter==0){
// 					// exit();
// 					if(implode("", $categories) == "all" || implode("", $categories) == "All" ){
// 						$sqlStr = "SELECT * FROM videos ORDER BY dislikes ASC LIMIT " . $numPerPage . " OFFSET " . $offset;
// 					}else{
// 						$sqlStr = "SELECT * FROM videos WHERE vCat like '%".implode("%' OR vCat like '%", $categories)."%'";
// 						$sqlStr .= " ORDER BY dislikes ASC LIMIT " . $numPerPage . " OFFSET " . $offset;
// 					}
// 				}
// 				else if($filter == 3){
// 					// exit();
// 					//Unseen videos filter.
// 					if(implode("", $categories) == "all" || implode("", $categories) == "All" ){
// 						$sqlStr = "SELECT * from videos where vId NOT IN (select vId from userLikedVideos where uID = ".$user.")";
// 					}else{
// 						$sqlStr = "SELECT * from videos where vId NOT IN (select vId from userLikedVideos where uID = ".$user.")";
// 						$sqlStr .= " and vCat like '%".implode("%' OR vCat like '%", $categories)."%'";
// 					}
// 				}
// 				else{
// 					// exit();
// 					if(implode("", $categories) == "all" || implode("", $categories) == "All"){
// 						$sqlStr = "SELECT * FROM videos ORDER BY likes ASC LIMIT " . $numPerPage . " OFFSET " . $offset;
// 					}else{
// 						$sqlStr = "SELECT * FROM videos WHERE vCat like '%".implode("%' OR vCat like '%", $categories)."%'";
// 						$sqlStr .= "LIMIT " . $numPerPage . " OFFSET " . $offset;
// 					}

// 				}
// 		//Run Query
// 		try
// 		{
// 			$stmt = $dbConnection->query($sqlStr);
// 			if($stmt->rowcount() == 0){
// 				//If there is no results found - Randomly find videos.
// 				$stmt = $dbConnection->query("SELECT * FROM videos ORDER BY RAND() LIMIT 1");
// 				// echo "IN IF<br />";
// 			}
// 			if($stmt === false)
// 			{
// 				die("Error executing the query: $sqlStr");
// 			}
// 		}
// 		catch(PDOException $error)
// 		{
// 			//Display error message if applicable
// 			echo "An error occured: ".$error->getMessage();
// 		}

// 		$numRecords = $stmt->rowcount();
// 		$arrValues = $stmt->fetch(PDO::FETCH_ASSOC);

// 		// echo "Number of records found: ".$numRecords." -";
// 		// echo $arrValues['vEmbed'];
// 		return array($arrValues['vEmbed'], $arrValues['likes'],$arrValues['dislikes'], $numRecords, $arrValues['vCat'], $arrValues['vId']);

// 		//Close the databaase connection
// 		$dbConnection = NULL;
// 	}

	include ("head.php");
	//Required for connecting
	require_once("../dal/connections/connections.php");
	//Required for the matching functions used in this file.
	require_once("../dal/display/functions.php");
	$vidNumber = 1;	
	if(isset($_GET['vidNumber'])) $current_number = $_GET['vidNumber'];
		
	// $randVideoDemo = rand(1, 3); //Eventually change to login system.
	// $randUser = rand(1, 3); //Eventually change to login system.
	
	$staticTestUser = 2;
	$cats = array("surfing");

	// $choice = $_REQUEST['change_sort']; 
	// echo $choice;
		
	
		//Check for the filter they've selected
		if(isset($_GET['sort'])){			
			$sort = $_GET['sort'];
		}else{
			$sort = 1;
		}
		if(isset($_POST['change_sort'])){
			 $sort = $_POST['sort-results'];
			 $showCatFunc = showCategory($cats, $sort,$staticTestUser);
			 header("Location: most-liked.php?vidNumber=0&cat=".$_GET['cat']."&sort=".$sort);
		 
		}

	if(isset($_GET['cat'])){
		
		// parse_str($_GET['cat'], $cats)
		// header("Location: most-liked.php?vidNumber=$vidNumber&cat=".$_GET['cat']);
		$cats = explode(",", $_GET['cat']);
		$showCatFunc = showCategory($cats, $sort, $staticTestUser);
		$showVideos = $showCatFunc[0];  //Embed Code
		$videoCats = $showCatFunc[4]; 
		$likes = $showCatFunc[1];
		$dislikes = $showCatFunc[2];
		$rowLength = $showCatFunc[3];
		$videoId = $showCatFunc[5]; //Video ID
		
		
	}
	else{
		// header("Location: most-liked.php?vidNumber=$vidNumber&cat=".implode(',', $cats));
		//If there is not QUERY STRING &cat= then run the default array $categories
		$showCatFunc = showCategory($cats, $sort, $staticTestUser);
		$showVideos = $showCatFunc[0];
		$rowLength = $showCatFunc[3];
		$likes = $showCatFunc[1];
		$videoCats = $showCatFunc[4];
		$dislikes = $showCatFunc[2];
		$videoId = $showCatFunc[5];
	}

	if(isset($_POST['btnDislike'])){	
		recordLikes(0, $staticTestUser, $videoId);
		//When ready add in the like recording.
	}
	else if(isset($_POST['btnLike'])){
		recordLikes(1, $staticTestUser, $videoId);
		//When ready add in the dislike recording.
	}
?>
<main>

	<div class='controller-wrap'>
		<div class='container'>
		<h3>Category: </h3>
			<form method='post'>
		    	<?php
					$allCategories = ["All", "Sport", "Automotive", "Comedy", "Misc", "Surfing", "cars", "gaming","f1"];
					$htmlOutput = "";
					$i=0;
						for($i;$i<sizeof($allCategories);$i++)
				        {	
				        	if($allCategories[$i] == "Surfing"){
				        		$htmlOutput .= "<input selected='selected' type='checkbox' name='chkCat[]' value='".$allCategories[$i]."'/>".$allCategories[$i];
				        	}
				        	else{
				        		$htmlOutput .= "<input type='checkbox' name='chkCat[]' value='".$allCategories[$i]."'/>".$allCategories[$i];
				        	}
				        }	
				    $htmlOutput .= "<input type='submit' value='Change Category' class='btnlike btnLike' name='btnChangeCat'/>";
			        echo $htmlOutput;
		    	?>
	    	</form>
			<h3>Sort: </h3>
			<form method="post" name='change_sort'>
				<select name='sort-results'>
					<option value='1' <?php if($sort == 1)echo "selected='selected'"?>>Most Liked</option>
					<option value='3' <?php if($sort == 3)echo "selected='selected'"?>>Videos I haven't seen</option>
					<option value='0'<?php if($sort == 0)echo "selected='selected'"?>>Most Disliked</option>
				</select>
				<input type='submit' value='Change' name='change_sort' />
			</form>

			<br />
			<div class='match-image'>
				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $showVideos ?>" frameborder="0" allowfullscreen></iframe>
			</div>
			<form style='float: left;' action="most-liked.php?vidNumber=<?php if($vidNumber == 1){$vidNumber = ($_GET['vidNumber']+=1); echo $vidNumber;} 
				echo "&cat=".$_GET['cat']; echo "&sort=".$sort;?>" method="post">
				<input type='submit' value='dislike' class='btnlike btnDislike' name='btnDislike' />
				<input type='submit' value='like' class='btnlike btnLike' name='btnLike'/>
			</form>
				<input type='submit' value='Share' class='btnlike btn-share-hover' name='btnShare' /> 
				<div class='share-wrap'>
				<form method='post'>
					<input type='submit' value='Your Profile' class='btnlike btn-share-vid' name='btnShareVidToProfile' />
					<!--hidden details for ajax -->
						<input type='hidden' value='<?php echo $showVideos; ?>' class='btnlike video_embed' />
						<input type='hidden' value='<?php echo $staticTestUser; ?>' class='btnlike video_user' />
					<!--hidden details for ajax -->
					<textarea name='txtShareVidStatus' placeholder='say something about the video...'></textarea> 
					</form>
					<div class="fb-share-button" data-href="<?php echo "http://localhost/funProjects/youtube/PHP/most-liked.php?vidNumber=".$vidNumber."&cat=".$_GET['cat']."&".$_GET['sort']; ?>" data-layout="button_count"></div>				
				</div>
			<?php 
				//If they click share the embed code will be put into the database.
				if(isset($_POST['btnShareVidToProfile'])){
					// echo $my_array_of_vars['v']; 
					if(isset($_POST['txtShareVidStatus'])){
						$post_details = $_POST['txtShareVidStatus'];
					}else{
						$post_details = "null";
					}
					insertPost($staticTestUser, $post_details, $showVideos);
					// header("Location: most-liked.php?vidNumber=".($_GET['vidNumber']-1)."&cat=".$_GET['cat']."&sort=$sort");

				}


				//Get the values of the checked checkboxes and place them in an array.
				$cat_array = array();
				if(isset($_POST['chkCat'])){
					if(is_array($_POST['chkCat'])) {
					    foreach($_POST['chkCat'] as $value){
					      array_push($cat_array, $value);
					    }
					    // header("Location: most-liked.php?vidNumber=0&cat=".implode(',', $cat_array)."&sort=".$sort);
					}else{
						    $value = $_POST['chkCat'];
						    array_push($cat_array, $value);
						    // header("Location: most-liked.php?vidNumber=0&cat=".implode(',', $cat_array)."&sort=".$sort);
					  	}
				}
				//When change cat button clicked, add categories in check array.
				if(isset($_POST['btnChangeCat'])){
					header("Location: most-liked.php?vidNumber=0&cat=".implode(',', $cat_array)."&sort=".$sort);
				}


				//Display stats about the video -
				echo "<div class='video-stats'>";
				echo " -- Total likes:  ".$likes;
				echo " -- Total dislikes:  ".$dislikes;
				if(isset($videoCats)){
					echo " -- Categories: ". $videoCats;
				}
				echo "</div>";
			?>
		<?php
		
		//Eventually replace with logged in user ID
		showUserPlaylists($staticTestUser);

		if($numRecords == 0){
        	echo "<span class='error'>No playlists found for this user</span><br /><br />";
      	}else{
      		$htmlSelect = "<div class='add-playlist'>";
      		$htmlSelect .= "<form name='userPlaylistForm' action='most-liked.php?vidNumber=".($vidNumber-1)."&cat=".implode(",", $cats)."&sort=".$sort."' method='post'>";
      		$htmlSelect .= "<select name='userPlaylists'>";
      			$htmlSelect .= "<option selected='selected' disabled='disabled' value='Add to playlist'>Add to playlist</option>";
			while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC)){
				//Possible SQL injection - playlist id in option value
				$htmlSelect .= "<option value=".$arrRows['pID'].">".$arrRows['pName']."</option>";
			}
			$htmlSelect .= '</select>';
			$htmlSelect .= '<input type="submit" value="Add to playlist" name="btnInsertPlay" />';
			$htmlSelect .= '</form>';
			$htmlSelect .= '</div>';
			echo $htmlSelect;

			//Insert the video ID into the selected playlist
			if(isset($_POST['btnInsertPlay'])){
				insertPlaylistVideo($_POST['userPlaylists'], $videoId);
				// header("Location: most-liked.php?vidNumber=".($_GET['vidNumber']-1)."&cat=".$cats);
			}
		}
		?>
		<!-- Facebook share button -->
		<!-- <div class="fb-share-button" data-href="<?php /*echo "http://localhost/funProjects/youtube/PHP/most-liked.php?vidNumber=".$vidNumber."&cat=".$_GET['cat'];*/ ?>" data-layout="button_count"></div> -->

		<br />
		<div class='container'>
		<form name='userComment' method="post">
			<textarea name='txtUserComment' placeholder='Enter comment here...'></textarea>
			<input type='submit' value='Post' name='submitComment' />
		</form>
		<div class='user-decision'></div>
			<?php
			if(isset($_POST['submitComment'])){
				$user_comment = $_POST['txtUserComment'];
				if($user_comment != ""){
					insertComment($staticTestUser, $videoId, $user_comment);
					//Prevent comment from being created again on refresh.
					// header("Location: most-liked.php?vidNumber=".($_GET['vidNumber']-1)."&cat=".$_GET['cat']);

				}
				else{
					echo "Please enter a comment before posting it.";
				}
				// unset($user_comment);
			}
			//Print out the comments
			showComments($videoId, $staticTestUser);
			?>
		</div><!-- End of .container -->
		<script>
		function delpost(id){
			if(confirm("Are you sure?")){
			var cID = id;
			$.ajax({
			    type: "POST",
			    url: "../bll/del_comment.php",
			    data:{ cID : id },
			    success: function(data){
			        $('#comment'+id).remove();
			        $('.user-decision').html("<div class='deleted-comment'>comment deleted</div>");
			    }
			});
			}
		}
		</script>
		<?php
		// if (isset($_POST['cID'])){
		// echo '<script type="text/javascript">location.reload();
		// </script>';
		// }
		?>
		


		</div>
	</div>
</main>
<script>
// function getIPL(id)
//     {
//             $.ajax({
//                        type: "POST",
//                        url: "addPlaylist.php",
//                        data: "emp_Id =" + id,
//                        success: function(result){
//                          $("#somewhere").html(result);
//                        }
//                      });
    // };
</script>
<?php
	//Issets(), if(), onClick below.


	
	include ("footer.php");
?>