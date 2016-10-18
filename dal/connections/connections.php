<?php

	//Databse Connection Variables
	$localhost = "localhost";
	$user = "root";
	$password = "root";
	$db = "youtube";
	$dsn = "mysql:host=$localhost;dbname=$db;";

	//Declare Global Variables
	$dbConnection = null;
	$stmt = null;
	$numRecords = null;

	//Establish MySQL Connection
	function connect()
	{
		global $user, $password, $dsn, $dbConnection;  //Required to accessglobal variables
		try
		{
			//Create a PDO connection with the configuration date
			$dbConnection = new PDO($dsn, $user, $password);
			$dbConnection ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbConnection;
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}
	}


?>