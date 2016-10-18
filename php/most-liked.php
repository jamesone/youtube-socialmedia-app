<?php
	/*
		Includes/requires
	*/
		include ("head.php");
	/*
		Includes/requires
	*/

	/* 
		Validate the query string/URL
	*/
		//Validate the vidNumber
		if(!isset($_GET['vidID'])){
			if(!isset($_GET['vidNumber'])){
				header("Location: most-liked.php?vidNumber=0&cat=all&sort=1");
			}
			else if(isset($_GET['vidNumber'])){
				if(!is_numeric($_GET['vidNumber'])){
					header("Location: most-liked.php?vidNumber=0&cat=all&sort=1");
				}
			}
		}
		else if(isset($_GET['vidID'])){
			// if(isset($_GET['sort'])){
			// 	header("Location: most-liked.php?vidID=".$_GET['vidID']."&sort=4");
			// }
		}

		//Validate sort
		if(isset($_GET['sort'])){
			$sort = $_GET['sort'];
		}else if(!is_numeric($sort)){
			$sort = 1;
		}
		else{
			$sort = 1;
		}
	/* 
		Validate the query string/URL
	*/

	/*
		Session validation
	*/
		$user_id = 0;
		if(checkSession()){
			$user_Id = $_SESSION['id'];
		}


		// //Use form elements from here
		// //http://getbootstrap.com/components/#btn-dropdowns
		// if(checkSession() == 1 || checkSession() == 2){
		// 	$user_Id = $_SESSION['id'];
		// }
		
		// if(checkSession() == 0){
		// 	$user_Id = 0;	
		// }
		// $user_Id = 0;	
		// if(isset($_SESSION['logged'])){
		// 	$user_logged = validate_key($_SESSION['logged']);

		// 	// print_r_nice($user_logged);
		// 	$_SESSION['id'] = $user_logged['uID'];
		// 	$_SESSION['name'] = $user_logged['name'];
		// 	$_SESSION['avatar'] = $user_logged['avatar'];

		// 	$user_Id = $_SESSION['id'];
		// }
		
	/*
		Session validation
	*/
	
	
	//Required for the matching functions used in this file.
	$vidNumber = 1;
	if(isset($_GET['vidNumber'])) $current_number = $_GET['vidNumber'];
	

	/*
		Default category array if something were to go wrong.
	*/
	$cats = array("all");
		
	
		
	if(isset($_POST['change_sort'])){
		$sort = $_POST['sort-results'];
		$showCatFunc = showCategory($cats, $sort,$user_Id);
		header("Location: most-liked.php?vidNumber=0&cat=".$_GET['cat']."&sort=".$sort);
	}
	if(isset($_GET['cat'])){
		// parse_str($_GET['cat'], $cats)
		// header("Location: most-liked.php?vidNumber=$vidNumber&cat=".$_GET['cat']);
		$cats = explode(",", $_GET['cat']);
		if(isset($_SESSION['id'])){
			$showCatFunc = showCategory($cats, $sort, $_SESSION['id']);
		}
		else{
			$showCatFunc = showCategory($cats, $sort, $user_id);	
		}
		$showVideos = $showCatFunc[0];  //Embed Code
		$videoCats = $showCatFunc[4];
		$likes = $showCatFunc[1];
		$dislikes = $showCatFunc[2];
		$rowLength = $showCatFunc[3];
		$videoId = $showCatFunc[5]; //Video ID
		
		
	}
	//If the user has shared a video and then another user has clicked on the link user this code ->
	//Fix this up to work with query etc...
	else if(isset($_GET['vidID'])){
		if(isset($_SESSION['id'])){
			$showCatFunc = showCategory($cats, $sort, $_SESSION['id']);
		}
		else{
			$showCatFunc = showCategory($cats, $sort, $user_id);	
		}
		$showVideos = $showCatFunc[0];
		$rowLength = $showCatFunc[3];
		$likes = $showCatFunc[1];
		$videoCats = $showCatFunc[4];
		$dislikes = $showCatFunc[2];
		$videoId = $showCatFunc[5];
	}
	else{
		// header("Location: most-liked.php?vidNumber=$vidNumber&cat=".implode(',', $cats));
		//If there is not QUERY STRING &cat= then run the default array $categories
		if(isset($_SESSION['id'])){
			$showCatFunc = showCategory($cats, $sort, $_SESSION['id']);
		}
		else{
			$showCatFunc = showCategory($cats, $sort, $user_id);	
		}
		$showVideos = $showCatFunc[0];
		$rowLength = $showCatFunc[3];
		$likes = $showCatFunc[1];
		$videoCats = $showCatFunc[4];
		$dislikes = $showCatFunc[2];
		$videoId = $showCatFunc[5];
	}

	/* 
		Record likes 
	*/
		if(isset($_SESSION['id'])){
			if(isset($_POST['btnDislike'])){
				recordLikes(0, $_SESSION['id'], $videoId);

				//When ready add in the like recording.
			}
			else if(isset($_POST['btnLike'])){
				recordLikes(1, $_SESSION['id'], $videoId);
				//When ready add in the dislike recording.
			}
		}
	/* 
		Record likes 
	*/
	
?>
<main>
<div class='controller-wrap'>
	<div class='container'>
		<?php
		$categories = array(
			'sport' => array(
			"surfing", "basketball", "nfl", "afl"
			),
			'Automotive' => array(
			"cars", "f1", "bikes", "etc"
			),
			'comedy' => array(
			"stand up", "pranks", "vv", "test"
			),
			'documentary' => array(
			"drugs", "environment", "other", "etc"
			),
			'movies' => array(
			"comedy", "action", "drama", "etc"
			),
		);
		?>
		<button class='show-hide-cats'>Choose categories</button>

		<div class='cat-wrap'>
		<h2>Choose some categories: </h2>
			<?php
				// Here is an imploded list, you don't need a second loop then
				foreach($categories as $cat => $subcat) {
					echo '<ul class=\'cat-chooser\'>';
					echo "<li class='cat-item' title='$cat' name='categories[]'>".$cat."</li><ul class='sub-cats-wrap'>";
					echo '<li class="cat-item" name="categories[]">'.implode('</li>'.PHP_EOL.'<li class="cat-item" name="categories[]">',$subcat).'</li></ul>';
					echo '</ul>';
				}
			?>
			<div class='seperator'></div>
		</div>
		<div class='chosen-cat-wrap'>
			<h3>Current: </h3><div class='chosen-cats'></div>
			<h3>Sort: </h3>
			<form method="post" name='change_sort'>
				<select name='sort-results'>
					<option value='1' <?php if($sort == 1)echo "selected='selected'"?>>Most Liked</option>
					<option value='3' <?php if($sort == 3)echo "selected='selected'"?>>Videos I haven't seen</option>
					<option value='0'<?php if($sort == 0)echo "selected='selected'"?>>Most Disliked</option>
				</select>
				<input type='submit' value='Change' name='change_sort' />
			</form>
		</div>
			
			<br />
			<div class='content-wrap'> <!-- Wraps around all content

				<!- <div class='match-image'> -->
				<div class='content-tile'>
					<div class='video-left'>
						<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $showVideos ?>" frameborder="0" allowfullscreen id='videoplayer-1'></iframe>
					</div>
					<!-- </div> -->
					
					<!-- <div class='details-block'> -->
					<div class='video-details'>
					<!-- <form action="most-liked.php?vidNumber=< //if($vidNumber == 1){$vidNumber = ($_GET['vidNumber']+=1); echo $vidNumber;} -->
						<form action="most-liked.php?vidNumber=<?php $vidNumber = $_GET['vidNumber']; echo $vidNumber;
							echo "&cat=".$_GET['cat']; echo "&sort=".$sort;?>" method="post">
							<input type='submit' value='like' class='btnlike btnLike' name='btnLike'/>
							<input type='submit' value='dislike' class='btnlike btnDislike' name='btnDislike' />
							<input type='submit' value='Share' class='btnlike btn-share-hover' name='btnShare' />
						</form>
						<form action="most-liked.php?vidNumber=<?php $vidNumber = ($_GET['vidNumber']+=1); echo $vidNumber;
							echo "&cat=".$_GET['cat']; echo "&sort=".$sort;?>" method="post">
							<input type='submit' value='Next' class='btnlike' name='btnNext' />
						</form>
						<form action="most-liked.php?vidNumber=<?php $vidNumber = $_GET['vidNumber']; echo ($vidNumber);
							echo "&cat=".$_GET['cat']; echo "&sort=".$sort;?>" method="post">
							<input type='submit' value='Prev' class='btnlike' name='btnPrev' />
						</form>
						
						<div class='bottom'>
							<div class='share-wrap'>
								<header>
									<h2>Post to your wall</h2>
								</header>
								<section>
									<article class='thumb'>
										<?php 	$youtubeAPI = youtube_title($showVideos);
												$thumbnail = $youtubeAPI[1];
												$title = $youtubeAPI[0];
										 ?>
										<div class='play-thumb'><?php echo $thumbnail; ?></div>
										<div class='share-embed-title'><?php echo $title; ?></div>
									</article>
									<br />
									<article class='form-section'>
										<form method='post'>
											<!-- <input type='submit' value='Your Profile' class='btnlike btn-share-vid' name='btnShareVidToProfile' /> -->
										<?php if(isset($_SESSION['id'])) { ?>
											<textarea name='txtShareVidStatus' placeholder='say something about the video...'></textarea>
										<?php }else{ 

										?>
											<textarea name='txtDummy' placeholder='Sign up or login to share to your user profile!'></textarea>
											<div class='signup-ad'><a href='login.php'>Login</a> or <a href='login.php'>Signup</a> to create playlists and much more!</div>
										<?php
											} 
										?>
										</form>
									</article>
									<br />
									<article class='social-media-share'>
										<span>Or post to facebook</span> <div class="fb-share-button" data-href="<?php echo "http://localhost/funProjects/youtube/PHP/most-liked.php?vidID=".$videoId; ?>" data-layout="button_count"></div>
									</article>

								</section>
								<footer>	
									<form method='post'><input type='submit' value='SHARE' class='btnlike btn-share-vid' name='btnShareVidToProfile' />
										<input type='button' value='Cancel' class='btnlike btn-share-vid cancel-share' name='btnShareVidToProfile' />
									</form>

								</footer>
							</div>
						</div>
						<?php
							//If they click share the embed code will be put into the database.
						if(isset($_SESSION['id'])){
							if(isset($_POST['btnShareVidToProfile'])){
								if(isset($_POST['txtShareVidStatus'])){
									$post_details = $_POST['txtShareVidStatus'];
								}else{
									$post_details = "null";
								}
								insertPost($_SESSION['id'], $post_details, $showVideos);
							}
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
						?>
							<div class='video-stats'>
								<span><i class="fa fa-thumbs-o-up"></i> <?php echo $likes;?></span><span> <i class="fa fa-thumbs-o-down"></i><?php echo $dislikes; ?></span>
								<div class='seperator'></div>
							</div>
								<br />
							<div class='video-cats'>
							<div class='seperator'></div>
							<br />
								<?php
									$categories = explode(',', $videoCats);
									if(isset($videoCats)){
										echo'<span class=\'cat-list\'>'. implode('</span> <span class=\'cat-list\'>', $categories) .'</span>';
										// echo "<span class='cat-list'>". $videoCats . "</span>";
									}
								?>
							</div>
						</div>	
						<?php
						
						if(isset($_SESSION['id'])){
							//Eventually replace with logged in user ID
							$show_play = showUserPlaylists($_SESSION['id']);
							if($show_play == 0){
								echo "No playlists were found";
							}
							else{
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
										header("Location: most-liked.php?vidNumber=".($_GET['vidNumber']-1)."&cat=".$cats);
									}
							}
						}else{
							echo "<div class='signup-ad'><a href='login.php'>Login</a> or <a href='login.php'>Signup</a> to create playlists and much more!</div>";
						}
							?>
						
					</div>
					<!-- Facebook share button -->
					<!-- <div class="fb-share-button" data-href="<?php /*echo "http://localhost/funProjects/youtube/PHP/most-liked.php?vidNumber=".$vidNumber."&cat=".$_GET['cat'];*/ ?>" data-layout="button_count"></div> -->
					<br />
					<div class='container'>
						<div class='comment-form-wrap'>

					<?php 	
							/*
								Check to see if the user is logged in. If not then don't display the comment area
							*/
							if(isset($_SESSION['id']) != 0){ ?>
								<form class='comment-form' name='userComment' method="post">
									<textarea  name='txtUserComment' placeholder='Enter comment here...'></textarea>
									<input type='submit' value='Post' name='submitComment' />
								</form>
					<?php 	}
							else{
								echo "<div class='signup-ad'><a href='login.php'>Login</a> or <a href='login.php'>Signup</a> to post comments and much more!</div>";
							} 
					?>
						</div>
						<div class='user-decision'></div>
							<?php
									if(isset($_SESSION['id'])){
										if(isset($_POST['submitComment'])){
											$user_comment = $_POST['txtUserComment'];
											if($user_comment != ""){
												insertComment($user_Id, $videoId, $user_comment);
												//Prevent comment from being created again on refresh.
												// header("Location: most-liked.php?vidNumber=".($_GET['vidNumber']-1)."&cat=".$_GET['cat']);
											}
											else{
												echo "Please enter a comment before posting it.";
											}
											// unset($user_comment);
										}
									}
									//Print out the comments
									showComments($videoId, $user_Id);
							?>
						</div><!-- End of .container -->
					</div>
				</div><!-- End of content-wrap-->
				<div class='suggestions-wrap'>
					<h2>You may be interested in:</h2>
				</div>
			</div>
			</main>
			<?php
				include ("footer.php");
			?>