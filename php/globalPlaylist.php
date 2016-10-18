<?php
ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(-1);
	include ("head.php");
	require_once("../dal/display/functions.php");
	if(isset($_SESSION['logged'])){
		$user_logged = validate_key($_SESSION['logged']);
		print_r_nice($_SESSION);

	}
	
	$vidNumber = 1;	
	$staticTestUser = 2;

?>
<main>
	<!-- <div class='controller-wrap'> -->
		<!-- <div class='playlist-container'> -->
			<?php 
				showPlaylist("global");
				$htmloutput="";
				if($numRecords == 0){
					echo "<div class='no-found'>No playlists found</div>";
				}
				else{
						// $htmloutput = "<div class='playlist-wrap'>";
							// $playName = $stmt->fetchColumn(5);
							// echo $playName;
						$title_array = array();
						$likes_array = array();
						$i=1;

					// while($arrRows = $stmt->fetch(PDO::FETCH_ASSOC)){
					$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
					foreach($rows as $key => $arrRows){
							//Resultset
							$embedCode = $arrRows['vEmbed'];
							$vID = $arrRows['vId'];
							$playTitle = $arrRows['pName'];

							//Youtube API results
							$youtubeAPI = youtube_title($embedCode);
							$title = $youtubeAPI[0];
							$thumbnail = $youtubeAPI[1];
							array_push($title_array, $playTitle);
							if(!(end($title_array) == prev($title_array))){
									
								?>
								</div>
								</div>
								<h2><?php echo $playTitle; ?></h2>
								<div class='slider'>";
									<div id="left" class="left">&lt;</div>
   									<div id="right" class="right">&gt;</div>
									<div class='playlist'>
						<?php
							}
						?>
							
							<div class='playlist-slider-item' title='Click to play!' data-embed='<?php echo $embedCode; ?>'>
								<div style='background-image: url("http://img.youtube.com/vi/<?php echo $embedCode ?>/mqdefault.jpg")'  class='play-thumb'></div>
								<div class='play-title'><?php echo substr($title, 0,20); ?>...</div>
							</div>
							<?php 
							}
						// echo $htmloutput;
					}
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


			<?php

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
	<!-- </div> -->
</main>

<script>
$(document).ready(function() {
	$('.playlist-slider-item').click(function(event) {
		var embedCode = $( this ).attr( "data-embed" );
		var showVideo = "<div class='video-show'>";
		showVideo += "<iframe src='https://www.youtube.com/embed/"+embedCode+"'frameborder=\"0\" allowfullscreen></iframe>";
								// $htmloutput .= "<div class='play-title'>".substr($title, 0,30)."...</div>";
		showVideo += "</div>";				// $htmloutput .= "</div>";
		$(this).prev('.slider').append(showVideo);

	});
	timer = null;
	
		$('.left').mouseenter(function() {
 		var left = parseInt($(this).next('.playlist').css('left'));
 			setInterval(function() {
		      		$(this).next('.playlist').css('left', left+2);
		      }, 10);

	     });

		$('.right').mouseenter(function() {
			 		var right = parseInt($(this).next('.playlist').css('left'));
			 		setInterval(function() {
					     $(this).next('.playlist').css('left', right-2);
					 }, 10);
					     
		});

		// $('.right').hover(function() {
		// 	if($(this))
		// }, function() {
		// 	/* Stuff to do when the mouse leaves the element */
		// });
					 // var x = 10; // number of milliseconds
					// var intervalId;
					// $('.myiv').hover(
					    // function () {
					        // the element is hovered over... do stuff
					        // intervalId = window.setInterval(move, x);
					    // }, 
					//     function () {
					//         // the element is no longer hovered... do stuff
					//         window.clearInterval(intervalId);
					//     }
					// );

	     
		// setInterval(function() {
		// 	if(hover==true){

		// 	}
		// }, 50);


	// $('.play-thumb').hover(function() {
	// 	$('.hover-details').fadeIn('slow');

	// 	}, function() {
	// 	/* Stuff to do when the mouse leaves the element */
	// 	});
	// });

	// }, 10);
	
		 // $('#left').hover(function() {
		 //    	$left = parseInt($(this).next('.playlist').css('left'));
		 //    	alert(left);
		 //    	 $(this).next('.playlist').css('left', ($left+2));
		 //    });
		 //     $('#right').hover(function() {

		 //     	var right = parseInt($(this).next('.playlist').css('left'));
		 //     	alert(right);
		 //    	 $(this).next('.playlist').css('right', (right-2));
		 //    });

		     


	 // }, 10);

	
});
</script>
<?php
	//Issets(), if(), onClick below.

	include ("footer.php");
?>