<?php
	include ("head.php");
	//Required for connecting
	require_once("../dal/connections/connections.php");
	//Required for the matching functions used in this file.
	require_once("../dal/display/functions.php");
	require_once("../dal/music_functions.php");
		
	// $randVideoDemo = rand(1, 3); //Eventually change to login system.
	// $randUser = rand(1, 3); //Eventually change to login system.
	
	$staticTestUser = 2;
	$cats = array("surfing");
	?>
	<script>
		datas = "";
		player = $('.player').clone();
		$.get( "https://api.spotify.com/v1/tracks/0eGsygTp906u18L0Oimnem", function( data ) {
			  // $( ".result" ).html( JSON.stringify(data,null, "\t") );
			  datas = data;
			  

			  // player.find('source').attr('src', JSON.stringify(data['preview_url']));
			  // $('.result').html(player);
			  // alert( "Load was performed." );
		}).success(function(data) { 
			var preview = JSON.stringify(data["preview_url"]);
			var preview_final = preview.substring(1, preview.length-1);
			var player = "<source src='"+preview_final+"' type='audio/mp3'>";
			$('.player audio').append(player);


		});
	</script>	
	<div class='player'>
		<audio controls>
			 <!--  <source class='src' src='' type="audio/mp3"> -->
			Your browser does not support the audio element.
		</audio>
	</div>
	<div class='result'></div>

<?php
include ("footer.php");

?>