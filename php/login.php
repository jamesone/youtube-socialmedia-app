<?php
	
	//header/nav
	include ("head.php");

	if(isset($_SESSION['logged'])){
		header("Location: most-liked.php");
	}

?>
<main class='login-page-wrap'>
	<div class='controller-wrap'>
		<div class='signup-wrap'>
			<form method="post">
				<div class='block'>
				<h2>Signup</h2>
					<!-- Required details -->
					Name*: <input type='text' name='LtxtName' class='LtxtName' placeholder='Enter your name...' />
					Password*:<input type='password' name='LtxtPass' class='LtxtPass' placeholder='Enter your password...' />

					<!-- This will be used as the login -->
					Email*:<input type='email' name='LtxtEmail' class='LtxtEmail' placeholder='Enter your email...This will be used as your username' />

					<!-- About, not required -->
					Description*:<textarea name='LtxtAbout' placeholder="Enter something about yourself...This can be done at a later stage if you wish"></textarea>
				</div>

				<!-- Profile image, has default so is not required -->
				<input type="file" name="fileToUpload" id="fileToUpload"><br />
				Gender:<br />
				Male: <input type='radio' name='radSex' value='male' />
				<br />Female: <input type='radio' name='radSex' value='female' checked="checked" />
				<br /><label for='Rremember'>Remember me</label>
				<input type='checkbox' name='Rremember' class='RrememberMe' value='yes' /><br />

				<input type='submit' name='LbtnSubmit' class='LbtnSubmit' />
			</form>
			<?php
			if(isset($_POST['LbtnSubmit'])){
				if(isset($_POST['LtxtName'])) $name = $_POST['LtxtName'];
				if(isset($_POST['LtxtPass'])) $pass = $_POST['LtxtPass'];
				if(isset($_POST['LtxtEmail'])) $email = $_POST['LtxtEmail'];
				if(isset($_POST['LtxtAbout'])) $about = $_POST['LtxtAbout'];
				// if(isset($_POST['LtxtPass'])) $password = $_POST['LtxtPass'];
				if($_POST['radSex'] =="male"){
					 $gen = 1;
				}
				else{
					$gen = 0;
				}
				if(isset($_POST['Rremember'])){ 
					$remem = "yes";
				}
				else{
					$remem = "no";
				}

				newUser($name, $pass, $email, $about, $gen, $remem);
			}
			// else if(isset($_POST['Rremember'])){
			// 	$_CO
			// }
			?>	
		</div>
	<div class='login-wrap'>
	<h2>Login</h2>
		<div class='block'>
			<form method='post'>
				<!-- Login -->
				Email*:<input type='email' name='LogtxtEmail' value='root@root.com' class='txtEmail' placeholder='Enter your email...This will be used as your username' />
				Password*:<input type='password' name='LogtxtPass' value='root' class='txtPass' placeholder='Enter your password...' />
				<input type='submit' name='btnLogin' class='btnSubmit' value='Login' />

			</form>
			<?php

				if(isset($_POST['btnLogin'])){
					$email = "";
					$pass = "";
					// echo "Please enter your password";
					if(isset($_POST['LogtxtEmail'])){
						$email = $_POST['LogtxtEmail'];

						// return "Enter an email";
					}
					
					if(isset($_POST['LogtxtPass'])){
						$pass = $_POST['LogtxtPass'];
						// echo "HIHIHI".$pass;
						// echo "Enter a password";
					}
					echo $_POST['LogtxtPass'];
					authenticate_user($email, $pass);
					header("Location: login.php");

				}
			?>
		</div>

	</div>

<!-- End of .controller-wrap (Pulls page away from left sidebar) -->
</div>

</main>
<?php
	//Issets(), if(), onClick below.

	include ("footer.php");
?>