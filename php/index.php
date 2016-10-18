<?php

	include ("head.php");

	//Required for connecting
	require_once("../dal/connections/connections.php");

	//Required for the matching functions used in this file.
	require_once("../dal/display/functions.php");

	$randVideoDemo = rand(1, 3); //Eventually change to login system.
	$randUser = rand(1, 3); //Eventually change to login system.
	$staticTestUser = 3;
	$showVideos = showVideos(1, 1, $staticTestUser)[0]; 
	// getLikes($showVideos);

	//Insert into the 'Matches' Table.
	if(isset($_POST['btnDislike'])){	
		echo "Disliked"; 
		recordLikes($showVideos, 0, $staticTestUser);
		// echo "<br /><br />ONE " . $showVideos;

	}
	else if(isset($_POST['btnLike'])){
		recordLikes($showVideos, 1, $staticTestUser);

		// echo " <br /><br />TWO" . $showVideos;
	}


?>
<main>

	<div class='controller-wrap'>
		<div class='container'>

			<div class='match-image'>
				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $showVideos ?>" frameborder="0" allowfullscreen></iframe>
			</div>
			<form action="index.php" method="post">
				<input type='submit' value='dislike' class='btnlike btnDislike' name='btnDislike' />
				<input type='submit' value='like' class='btnlike btnLike' name='btnLike'/>
			</form>
		</div>
		<?php
		// $apiKey = "AIzaSyA6jJD4brngNsLvKbblig2bBhuF9uGwjW4";
		// $json_output = file_get_contents("https://www.googleapis.com/youtube/v3/videos?id=".$showVideos."&key=" .$apiKey ."&fields=items(id,snippet(channelId,title,categoryId),statistics)&part=snippet,statistics");
		// $json = json_decode($json_output, true);
		// var_dump(json_decode($json));
		// $title = $json["snippet.title"];
		// $url = "https://www.googleapis.com/youtube/v3/videos?id=6pA5-WhsAfI&key=AIzaSyA6jJD4brngNsLvKbblig2bBhuF9uGwjW4&fields=items(id,snippet(channelId,title,categoryId),statistics)&part=snippet,statistics";
		// $content = file_get_contents($url);
		// var_dump(json_decode($content));

		// echo "<br />Title: ". $title;
		//showVideos(1, 1, $staticTestUser)
		echo "<br />Total likes:  ".showVideos(1, 1, $staticTestUser)[1]; 
		echo "<br />Total dislikes:  ".showVideos(1, 1, $staticTestUser)[2]; 

		?>
	</div>
</main>

<?php
	include ("footer.php");
?>