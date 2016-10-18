<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(-1);
//Working youtube title function

	include ("head.php");
	//Required for connecting
	require_once("../dal/connections/connections.php");
	//Required for the matching functions used in this file.
	require_once("../dal/display/functions.php");
	require_once("../dal/users/readUsers.php");


	// define('ROOT', '../');
	$vidNumber = 1;	
	if(isset($_POST['follow_user'])){
		$staticTestUser = $_POST['follow_user'];
		if($_POST['follow_user'] != ""){
			setcookie('staticTest', $staticTestUser);
		}
		$loggedInTestUser = 1;
	}

	

	if(isset($_COOKIE['staticTest'])){
		$staticTestUser = $_COOKIE['staticTest'];
		$loggedInTestUser = 1;
	}

?>
<main>
<?php flush(); ?>
	<div class='controller-wrap'>
		<!-- <div class='playlist-container'> -->
			<?php 
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
				?>

				<div class='sidebar'>
					<div class='user-details'>
							<?php
							userProfile($staticTestUser);
							$start_time = time();
							if(!($stmt->rowCount() == 0)){
								$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
									foreach($rows as $key => $arrRows){

								?>
								<img src='../assets/uploads/user/<?php echo $arrRows['avatar']; ?>' alt='User Profile' />
									<div class='text-details'>
										<?php echo $arrRows['name'] . "<br />" . $arrRows['about'];  

										?>
									</div>
								<?php
								}
							}
							?>
							<form method="post">
								<?php
									checkFollow($loggedInTestUser, $staticTestUser);
									if($stmt->rowCount() > 0){										
								?>
									<button class='button-followed' type="submit" name='unfollow_user'>Following</button>
								<?php
									}
									else{
								?>
									<button type="submit" name='follow_user'>Follow</button>
								<?php
									}
								?>
							</form>
							<?php
								if(isset($_POST['follow_user'])){
									insertFollower($loggedInTestUser, $staticTestUser);
								}

								if(isset($_POST['unfollow_user'])){
									removeFollow($loggedInTestUser, $staticTestUser);
								}
							?>
					</div>
					<?php

				showPlaylist($staticTestUser);
				if($numRecords == 0){

					echo "<div class='no-found'>No playlists found</div>";
				}
				else{
					?>
					<!-- <div class='playlist-wrap'> -->
						
						<?php
							// $playName = $stmt->fetchColumn(5);
							// echo $playName;
						$title_array = array();
						$likes_array = array();

						$currentPlayTitle = '';

						$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
						foreach($rows as $key => $arrRows){

							$htmloutput = "";
								$embedCode = $arrRows['vEmbed'];
								$vID = $arrRows['vId'];
								$youtubeAPI = youtube_title($embedCode);
								$title = $youtubeAPI[0];
								$thumbnail = $youtubeAPI[1];
								$playTitle = $arrRows['pName'];
							array_push($title_array, $playTitle);
							array_push($likes_array, $arrRows['pID']);

							?>
							<div class='playlist-head'>
							<?php
							if($playTitle != $currentPlayTitle){
								if($key != 0){
									$prevArrRow = $rows[$key-1];
									$playId = $prevArrRow['pID'];
								?>
									<div class='playlist-footer'>
										<div class='play-stats'>"
									<?php
										echo "Likes:".$prevArrRow['likes']." -- Dislikes: ".$prevArrRow['dislikes'];
									?>
										</div>

										<div class='play-vote'>
											<form action='myprofile.php' method='post'>
												<button name='playLike' type='submit' value='<?php echo $playId; ?>'>Like</button>
												<button name='playDislike' type='submit' value='<?php echo $playId; ?>'>Dislike</button>
											</form>
										</div>
									</div>
								<h2><?php echo $playTitle; ?></h2>
								<?php
									}
									$currentPlayTitle = $playTitle;
									
								}
									?>
							</div>
		

							<div class='playlist-item' title='Click to play!'>
								<div class='play-thumb'><?php echo $thumbnail; ?></div>
								<div class='play-title'><?php echo substr($title, 0,10); ?>...</div>
							</div>
							<!-- 
							//Hidden video - triggered on click function - -->
							<div class='playlist-video-show'>
								<iframe width="56" height="315" src="https://www.youtube.com/embed/<?php echo $embedCode; ?>" frameborder="0" allowfullscreen></iframe>
								<form action='myprofile.php' method='post'>
									<button name='playVidLike' type='submit' value='<?php echo $vID; ?>'>Like</button>
									<button name='playVidDislike' type='submit' value='<?php echo $vID; ?>'>Dislike</button>
								</form>
							</div>
					<?php
						}
					?>
				<?php
					// $htmloutput = '';		
					if(!$numRecords == 0){			
						$prevArrRow = $arrRows;
						$playId = $prevArrRow['pID'];
					}
				?>
					<div class='playlist-footer'>
							<div class='play-stats'>

								<?php 
									if(!$numRecords == 0){	
										echo "Likes:".$prevArrRow['likes']." -- Dislikes: ".$prevArrRow['dislikes']; 
									}
									?>
							</div>
						<div class='play-vote'>
							<form action='myprofile.php' method='post'>
								<button name='playLike' type='submit' value='<?php echo $playId; ?>'>Like</button>
								<button name='playDislike' type='submit' value='<?php echo $playId; ?>'>Dislike</button>
							</form>
						</div>
					</div>
				</div>
					
	<!-- END OF PLAYLIST SECTION  -->

				<?php 	
				}
				//Record if the user likes or dislikes the playlist.
				if(isset($_POST['playLike'])){
					recordPlayLikes($_POST['playLike'], 1);
					// header("Location: myprofile.php");
				}
				else if(isset($_POST['playLike'])){
					recordPlayLikes($_POST['playdislike'], 0);
					// header("Location: myprofile.php");
				}

				//Record the liked videos
				if(isset($_POST['playVidLike'])){
					recordLikes(1, $staticTestUser, $_POST['playVidDislike']);
					// header("Location: myprofile.php");
				}
				else if(isset($_POST['playVidDislike'])){
					echo "<script>alert('Disliked".$_POST['playVidDislike']."')</script>";
					recordLikes(0, $staticTestUser, $_POST['playVidDislike']);
					// header("Location: myprofile.php");
				}

				
			?>
		<!-- </div> -->
		<div class='feed-container'>
			<div class='feed-post'>
			<!-- <form action="myprofile.php" method="post"> -->
				<textarea class='post_data' name='post-update'></textarea>
				<input type="submit" name='post-submit' class='submit_post' value="post">
				<input type='hidden' id='ajax_logged_in' name='loggedInUser' value='<?php echo $staticTestUser; ?>'/>

			<!-- </form> -->
			</div>
			<?php
			//Post here - 
			if(isset($_POST['post-submit'])){
				$post_data = $_POST['post-update'];
				if($post_data != ""){
					insertPost($staticTestUser, $post_data,0);
				}
				else{
					echo "Please enter a message";
				}
			}
			?>
			<div class='post-container'>
			
			<?php
			$posthtml="";
			showPost($staticTestUser);
			if($numRecords == 0){
				echo "No posts found";
			}
			else{
				while($postRec = $stmt->fetch(PDO::FETCH_ASSOC)){
			?>
					<div class='post-wrap' id="post<?php echo $postRec['postID']; ?>">
						<div class='post-head'>
							<img class='prof-img' src='../assets/uploads/user/<?php echo $postRec['avatar']; ?>' alt='profile_pic' />
								<?php
										echo $postRec['name'];	
										echo substr($postRec['post_time'], 11);
								?>
						</div>
					<div class='post-content'>
						<?php
							if($postRec['post_data'] != 'null'){
								echo $postRec['post_data'];
							}
							if($postRec['post_embed'] != 'embed'){
								$embedCode = $postRec['post_embed'];
						?>
						<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $embedCode; ?>" frameborder="0" allowfullscreen></iframe>
						<?php
						//End of $postRec['post_embed'] != embed
							}
						?>
					</div>
						<div class='post-footer'>
							<a href='#' onClick='delUserPost("<?php echo $postRec['postID']; ?>")'>Delete Post</a>
						</div>
					</div>
			<?php
				} // End of if($numRecords == 0){} else{ 
			} // End of while loop?
			?>
			</div>

		</div>
	</div>
</main>
<script>
$(document).ready(function() {
	$('.playlist-item').click(function() {
		$(this).next(".playlist-video-show").toggle('slow/400/fast');
		// $(this).mouseenter(function(event) {
		// 	/* Act on the event */
		// });
		$(this).attr({
			title: 'click to close'
		});
		// .css({
		// 	width: '400px'
		// });;
		// $('.playlist-video-show').fadeIn('slow/400/fast', function() {
		// 	$(this).css({
		// 		display: 'inline-block',
		// 		width: '400px'
		// 	});
		// });
	});
});
		function delUserPost(postID){
			if(confirm("Are you sure?")){
			var postId = postID;
			$.ajax({
			    type: "POST",
			    url: "../bll/del_comment.php",
			    data:{ postID : postId },
			    success: function(data){
			        $('#post'+postId).remove();
			        // $('.user-decision').html("<div class='deleted-comment'>comment deleted</div>");
			    }
			});
			}
		}

		function addUserPost(){
			var postId = postID;
			$.ajax({
			    type: "POST",
			    url: "../bll/del_comment.php",
			    data:{ postID : postId },
			    success: function(data){
			        $('#post'+postId).remove();
			        // $('.user-decision').html("<div class='deleted-comment'>comment deleted</div>");
			    }
			});
		}


            $('.submit_post').click(function(event) {
            	var loggedInUser = $('#ajax_logged_in').val();
            	var postData = $('.post_data').val();

	            $.ajax({
	            type: "POST", // HTTP method POST or GET
	            url: "../dal/ajax.php", //Where to make Ajax calls
	            data:{ loggedInUser : loggedInUser, postData : postData } , //Form variables
	            success:function(response){
	                // $("#responds").append(response);
	                // $("#contentText").val(''); //empty text field on successful
	                // $("#FormSubmit").show(); //show submit button
	                // $("#LoadingImage").hide(); //hide loading image
	             
	                $('.post_data').val("");


	            },
	            error:function (xhr, ajaxOptions, thrownError){
	                // $("#FormSubmit").show(); //show submit button
	                // $("#LoadingImage").hide(); //hide loading image
	                alert("EROR: " + thrownError);
	            }
	            });
    	});
           


</script>
<?php
	//Issets(), if(), onClick below.
	include ("footer.php");
?>