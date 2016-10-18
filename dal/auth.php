<?php
	// require_once 'connections/connections.php';
	/*
		Prefixes: 
			1 - This means the account already exists

	*/
	function newUser($name, $pass, $email, $about, $gen, $remem){
		//Simple Validation of values - If false it will exit the function 
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			return 0;
		}
		else if($name==""){
			return 0;
		}
		else if($pass==""){
			return 0;
		}
		else if($about==""){
			$about = "This user has chosen not to leave a description";
		}
		else if($remem == ""){
			$remem = 0;
		}
		$avatar = "default.png";
		$auth = generateAuth();
		$datetime = date("Y-m-d H:i:s");

		/*
			Start server side validation - If all good then insert user
		*/
		$dbConnection = connect();
		$sqlCheck = "select * from user where email = '$email'";
		try{
			$stmt = $dbConnection->query($sqlCheck);

			if($stmt->rowcount() != 0){
				return 1;

			}else{
				$sql = "INSERT INTO user (email, name, about, avatar, gender, auth, start_date, password) VALUES ('$email', '$name', '$about', '$avatar', $gen ,' $auth ', '$datetime', '$password')";
				try{
					$stmt = $dbConnection->query($sql);
				}catch(PDOException $er){
					die("INSERT ERROR ->" . $er);
				}

			}
		}catch (PDOException $e){
			die("error was ---> " . $e);
		}

	}

	/*
		Re-usable authentication token function
	*/
	function generateAuth(){
		$auth = md5(microtime().rand());
		return $auth;
	}	



	/*
		Below is for authenticating the user and handing out the auth key
	*/
	function authenticate_user($username, $password){
		/* Validate the username and passcode sent VIA THE HTTPS data
			This validateUser function will return whether the passcode/username exists or not.
		*/
		$validated = validateUser($username, $password);
		/* This means the entered details have been validated and are correct*/
		if($validated == 1){

			$returned_values = give_key($username);
				/* Debug by checking whats been returned 
					print_r($returned_values);
				*/
			//Return the key
			$_SESSION["logged"] = $returned_values;
			return $returned_values;
		}
		/* This means the entered details have been validated and the password is wrong*/
		else if($validated == 2){
			return "Incorrect password";
		}
		/* This means the entered details have been validated and the user doesn't exist*/
		else{
			return 'This account doesn\'t exist';
		}

	}

/* This is a reusable function to check whether the user exists. All you need to pass is the username and password */
function validateUser($user, $pass){
	$db = connect(); 

	/*
	Dictionary:
	1 = User and password are a match
	2 = Username exists but the password is incorrect
	3 = Username doesn't exist. Meaning there is no account for this username
		- Future reference, I could use this and if an account doesn't exist then prompt the user to create a new one.
	*/

	$sqlCheck = "select email, password from user where email = '$user'";
	// $sqlCheck = "selct username, passcode from users where passcode = "

	//Run Query
		try
		{

			$stmt = $db->query($sqlCheck);
			//If the rowcount is != 0 then there has been data returned
			if($stmt->rowcount() != 0){
				//Now we check if the username and the password are both correct
				$sqlCheck = "select email, password from user where email = '$user' and password = '$pass'";
				$stmt = $db->query($sqlCheck);
					/* This means the entered details have been validated and the password is wrong*/
				if($stmt->rowcount() == 0){
					return 2;					
				}
					/* This means the entered details have been validated and are correct*/
				else{
					return 1;
				}
			}
			/* This means the entered details have been validated and the user doesn't exist*/
			else if($stmt->rowcount() == 0){
				return 3;
			}
			else if($stmt === false)
			{
				die("Error executing the query: $sqlCheck");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
}

/* 
	Another reusable function - This function returns the authentication key for the validated user
	Future reference:
		This function could be used for to handout  AUTHENTICATION keys for different situations. 
			E.g if the user is already signed up and wants some data from the API
 */
	function give_key($user){

		$db = connect(); 
		/*
		Dictionary:
			$sql_return = This is an array of all the values retrieved from the query.
			return array() = This returns an array of values, these values can be accessed easily using indexes
			$user = this is the email (users will login with this)
		*/
		$sqlCheck = "select auth from user where email = '$user'";

		//Run Query
			try
			{
				$stmt = $db->query($sqlCheck);
				/*
					Double check there's a value incase something goes wrong before returning key
				*/
				if($stmt->rowcount() != 0){
					$sql_return = $stmt->fetch(PDO::FETCH_ASSOC);
					/* Debug by checking whats been returned 
						// print_r($sql_return);
						// exit();
					*/
					return $sql_return['auth'];
				}
				else if($stmt === false)
				{
					die("Error executing the query: (An error has occured) $sqlCheck");
				}
			}
			catch(PDOException $error)
			{
				//Display error message if applicable
				echo "An error occured: ".$error->getMessage();
			}
	}	

	/*
		Resuable function
		Validate the key and return the user ID

	*/
	function validate_key($key){
		if($key == ""){
			return 0;
		}
		$db = connect();

		$sql = "select * from user where auth = '$key'";
		try{
			$stmt = $db->query($sql);
			if($stmt->rowcount() != 0){
				$fetch = $stmt->fetch(PDO::FETCH_ASSOC);
				return $fetch;
			}
			else if($stmt->rowcount() == 0){
				return "This user doesn't exist";
			}
			else if($stmt == false){
				die("False entry");
			}


		}catch(PDOException $err){
			die("PDO Exception error --> " . $err);
		}


	}


?>