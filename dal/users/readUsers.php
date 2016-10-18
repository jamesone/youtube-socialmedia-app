<?php
	function list_users(){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)


		//SQL Query - results sorted by specified column
		$sqlStr = "select * from user";

		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);

			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		//Close the databaase connection
		$dbConnection = NULL;
	}

	function checkFollow($uID, $fID){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)


		//SQL Query - results sorted by specified column
		$sqlStr = "select * from followers where uID = $uID and fID = $fID";

		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		//Close the databaase connection
		$dbConnection = NULL;
	}

	function removeFollow($uID, $fID){
		global $numRecords, $dbConnection, $stmt;
		connect(); //Run connect function (../connections/connections.php)


		//SQL Query - results sorted by specified column
		$sqlStr = "delete from followers where uID = $uID and fID = $fID";

		//Run Query
		try
		{
			$stmt = $dbConnection->query($sqlStr);
			if($stmt === false)
			{
				die("Error executing the query: $sqlStr");
			}
		}
		catch(PDOException $error)
		{
			//Display error message if applicable
			echo "An error occured: ".$error->getMessage();
		}

		//Close the databaase connection
		$dbConnection = NULL;
	}




?>