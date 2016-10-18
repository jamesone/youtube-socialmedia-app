
<?php

ini_set("display_errors", 1);
ini_set("display_startup_errors", 1);
error_reporting(-1);
//Working youtube title function

	//Remove the staticTest cookie used in otherProfile.php
	setcookie("staticTest", "", 1);


	include ("head.php");
	//Required for connecting
	require_once("../dal/connections/connections.php");
	require_once("../dal/users/readUsers.php");
	//Required for the matching functions used in this file.
	require_once("../dal/display/functions.php");
	// define('ROOT', '../');
	$vidNumber = 1;	
	
	$staticTestUser = 2;
	$loggedInTestUser = 1;

?>
<main>
	<div class='user-list-wrap'>
		<ul class='user-list'>
<?php
flush(); 
		//Get all users in DB
		list_users();

		$rows = $stmt->fetchAll();
		if(!$stmt->rowCount() == 0){
			foreach($rows as $key => $arrRows){

				?>
				<li>
					<img height='80px' width='80px' src="..//assets/uploads/user/<?php echo $arrRows['avatar']; ?>" alt='profile_pic' class='list-avatar' />
					<span><?php echo $arrRows['name']; ?></span><span><?php echo substr($arrRows['about'], 0, 20); ?></span>
					<form action='otherProfile.php' method="post">
						<button name='goto_user'>View Profile</button>
						<input type='hidden' name='follow_user' value="<?php echo $arrRows['uID']; ?>" /> 
					</form>
				</li>
	<?php
			}
			if(isset($_POST['goto_user'])){
				setcookie("staticTest", "", time()-(60*60*24), "/");
			}
		}
?>
		</ul>
	</div>
</main>
<?php
	//Issets(), if(), onClick below.
	include ("footer.php");

?>