<?php

	include ("head.php");
	/*
		Must be require once as the class cannot be redeclared in the same file.
	*/

	if(checkSession()){
			$user_Id = $_SESSION['id'];
	}

	// $vidNumber = 1;	
	$loggedInTestUser = 1;


?>
<main class='myprofile-page'>
<?php flush(); ?>
	<div class='controller-wrap'>
				<div class='sidebar'>
				<div class='container'>
					<div class='user-details'>
							<?php
							//Create the user_profile object
							$loggedIn = new user_profile($user_Id);
							$data_handler = new data_input($user_Id);

							//Show the users details
							$loggedIn->showUser();
							if(!($stmt->rowCount() == 0)){
								$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
									foreach($rows as $key => $arrRows){
								?>
								<img src='../assets/uploads/user/<?php echo $arrRows['avatar']; ?>' alt='User Profile' />
									<div class='text-details'>
										<span><?php echo $arrRows['name'] . "<br />" . $arrRows['about'];?><span><br />
										
								<?php
								}
								 	$followers = $loggedIn->showAmountFollowers();
          								echo $followers . " followers";
								?>
									</div>
							<?php
							}
							?>
					</div>
					<?php
				$loggedIn->showPlaylist();
				if($numRecords == 0){
					echo "<div class='no-found'>No playlists found</div>";
				}
				else{
					?>
					<div class='playlist-profile-wrap'>
						
						<?php
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
							
							<?php
							if($key == 0){
								?>

								<div class='playlist-head'>
									<h2><?php echo $playTitle; ?></h2>
								</div>

								<?php
							}

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
								<div class='playlist-head'>
									<h2><?php echo $playTitle; ?></h2>
								</div>
								<?php
									}
									$currentPlayTitle = $playTitle;
									
								}
									?>
		

							<div class='playlist-item' title='Click to play!'>
								<div class='play-thumb'><?php echo $thumbnail; ?></div>
								<div class='play-title'><?php echo substr($title, 0,20); ?>...</div>
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
					$prevArrRow = $arrRows;
					$playId = $prevArrRow['pID'];
				?>
					<div class='playlist-footer'>
							<div class='play-stats'>
								<?php echo "Likes:".$prevArrRow['likes']." -- Dislikes: ".$prevArrRow['dislikes']; ?>
							</div>
						<div class='play-vote'>
							<form action='myprofile.php' method='post'>
								<button name='playLike' type='submit' value='<?php echo $playId; ?>'>Like</button>
								<button name='playDislike' type='submit' value='<?php echo $playId; ?>'>Dislike</button>
							</form>
						</div>
					</div>
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
					$data_handler->recordUserLikes(1, $_POST['playVidLike']);
					// recordLikes(1, $user_Id, $_POST['playVidDislike']);
				}
				else if(isset($_POST['playVidDislike'])){
					echo "<script>alert('Disliked".$_POST['playVidDislike']."')</script>";
					// recordLikes(0, $user_Id, $_POST['playVidDislike']);
					$data_handler->recordUserLikes(0, $_POST['playVidDislike']);
				}

				
			?>
		<!-- </div> -->
		<div class='feed-container'>
			<div class='feed-post'>
			<form action="myprofile.php" method="post">
				<textarea class='post_data' name='post-update'></textarea>
				<input type="submit" name='post-submit' class='submit_post' value="post">
				<input type='hidden' id='ajax_logged_in' name='loggedInUser' value='<?php echo $user_Id; ?>'/>

			</form>
			</div>
			<?php
			//Post here - 
			if(isset($_POST['post-submit'])){
				$post_data = $_POST['post-update'];
				if($post_data != ""){
					// insertPost($user_Id, $post_data,0);
					$data_handler->insertPost($post_data, 0);
				}
				else{
					echo "Please enter a message";
				}
			}
			?>
			<div class='post-container'>
			
			<?php
			$posthtml="";
			//Show posts for logged in user (user_Id)
			$loggedIn->showPost();
			
			if($numRecords == 0){
				echo "No posts found";
			}
			else{
				?>
				<div class='appended-posts'></div>
				<?php
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
						<div class='post-footer'>
					</div>
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


	
</script>
<?php
	//Issets(), if(), onClick below.
	include ("footer.php");
?>