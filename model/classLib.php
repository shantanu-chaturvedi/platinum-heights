<?php include 'config.php';
class connect{
	function __construct(){		
	}
	function config(){         //database connectivity
		$config['server'] = $_SESSION['server'];
		$config['db'] = $_SESSION['db'];
		$config['user'] = $_SESSION['userName'];
		$config['pswd'] = $_SESSION['password'];
		return $config;
	}
}

class dbConnFunctions{     // sql queries
	function dbConn($query){
		try{
			$config = connect::config();
			$conn = new PDO("mysql:host=".$config['server'].";dbname=".$config['db'],$config['user'],$config['pswd']);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec("set names utf8");
			$result = $conn->prepare($query);
			return $result;
		}
		catch(PDOException $e){
			echo "Connection failed: ". $e->getMessage();
		}
	}
}

class dbFunctions{
	function getRowCount($query){
		$result = dbConnFunctions::dbConn($query);
		$result->execute();
		return $result->rowCount();
	}
		
	function getSingleValueResult($query){
		$result = dbConnFunctions::dbConn($query);
		$result->execute();
		return $result->fetchColumn();
	}
	
	function getResult($query){
		$result = dbConnFunctions::dbConn($query);
		$result->execute();
		return $result->fetchAll();
	}
	
	function executeQuery($query){
		$result = dbConnFunctions::dbConn($query);
		return $result->execute();
	}

	function activationKey(){
	    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	} 

	function lastInsertId($query){
		try{
			$config = connect::config();
			$conn = new PDO("mysql:host=".$config['server'].";dbname=".$config['db'],$config['user'],$config['pswd']);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec("set names utf8");
			$result = $conn->prepare($query);
			$result->execute();
			$id = $conn->lastInsertId();
			return $id;
		}
		catch(PDOException $e){
			echo "Connection failed: ". $e->getMessage();
		}
	}
}

class myFunctions{

	function insertToDb($tblname,$colname,$values){
		$query = 'INSERT INTO '.$tblname.' ('.$colname.') VALUES ('.$values.')';
		dbFunctions::executeQuery($query);
	}

	function insertToDbReturnInsertId($tblname,$colname,$values){
		$query = 'INSERT INTO '.$tblname.' ('.$colname.') VALUES ('.$values.')';
		$insertId = dbFunctions::lastInsertId($query);
		return $insertId;
	}

	function updateDataById($tblename,$values, $rowId){
		$query = 'UPDATE '.$tblename.' SET '.$values.' WHERE ID = "'.$rowId.'"';
		return dbFunctions::executeQuery($query);
	}

	function updateData($tblename,$values, $where){
		$query = 'UPDATE '.$tblename.' SET '.$values.' '. $where;
		return dbFunctions::executeQuery($query);
	}

	function deleteData($tblename,$rowId){
		$query = 'UPDATE '.$tblename.' SET deleted = 1 WHERE ID = "'.$rowId.'"';
		return dbFunctions::executeQuery($query);
	}

	function deleteDataWithConditions($tblename,$where){
		$query = 'UPDATE '.$tblename.' SET deleted = 1'.$where;
		return dbFunctions::executeQuery($query);
	}

	function uploadFile($sourcePath,$targetPath){
		move_uploaded_file($sourcePath,$targetPath); 
	}

	function rowCount($tblename,$where){
		$query = "SELECT * from ".$tblename." ".$where;
		return dbFunctions::getRowCount($query);
	}

	function getData($tblename,$where){
		$query = "SELECT * from ".$tblename." ".$where;
		return dbFunctions::getResult($query);
	}

	function getSelectedColumns($tblename,$colname,$where){
		$query = "SELECT ".$colname." from ".$tblename." ".$where;
		return dbFunctions::getResult($query);
	}
}

class signin{

	function updatePassword($password,$email,$activation_key){
		$query = 'SELECT ID from tbl_admin where deleted = 0 AND activation_key ="'.$activation_key.'" AND email ="'.$email.'" LIMIT 1';
		$rowsAdmin = dbFunctions::getRowCount($query);
		if($rowsAdmin > 0){
			$query = 'UPDATE tbl_admin SET password = "'.$password.'", activated = 1, activation_key = "" WHERE email = "'.$email.'" and activation_key = "'.$activation_key.'"';
			return dbFunctions::executeQuery($query);
		}

		$query = 'SELECT ID from tbl_partners where deleted = 0 AND activation_key ="'.$activation_key.'" AND email ="'.$email.'" LIMIT 1';
		$rowsPartner = dbFunctions::getRowCount($query);
		if($rowsPartner > 0){
			$query = 'UPDATE tbl_partners SET password = "'.$password.'", activated = 1, activation_key = "" WHERE email = "'.$email.'" and activation_key = "'.$activation_key.'"';
			return dbFunctions::executeQuery($query);
		}

		$query = 'SELECT ID from tbl_clients where deleted = 0 AND activation_key ="'.$activation_key.'" AND email ="'.$email.'" LIMIT 1';
		$rowsClient = dbFunctions::getRowCount($query);
		if($rowsClient > 0){
			$query = 'UPDATE tbl_clients SET password = "'.$password.'", activated = 1, activation_key = "" WHERE email = "'.$email.'" and activation_key = "'.$activation_key.'"';
			return dbFunctions::executeQuery($query);
		}
	}

	function login($username,$password){
		$password = trim($password);
		$password = md5($password);

		$data = "";

		$query = 'SELECT ID from tbl_admin where deleted = 0 AND username ="'.$username.'" AND password ="'.$password.'" LIMIT 1';
		$rowsAdmin = dbFunctions::getRowCount($query);
		if($rowsAdmin > 0){
			$result = dbFunctions::getResult($query);
			$data = $result[0]['ID'].'-1';
		}

		return $data;

	}

	function forgetPassword($activation_key,$email){
		$query = 'SELECT ID from tbl_admin where deleted = 0  AND email ="'.$email.'" LIMIT 1';
		$rowsAdmin = dbFunctions::getRowCount($query);
		if($rowsAdmin > 0){
			$query = 'UPDATE tbl_admin SET activation_key = "'.$activation_key.'" WHERE email = "'.$email.'"';
			return dbFunctions::executeQuery($query);
		}

		$query = 'SELECT ID from tbl_partners where deleted = 0 AND email ="'.$email.'" LIMIT 1';
		$rowsPartner = dbFunctions::getRowCount($query);
		if($rowsPartner > 0){
			$query = 'UPDATE tbl_partners SET activation_key = "'.$activation_key.'" WHERE email = "'.$email.'"';
			return dbFunctions::executeQuery($query);
		}

		$query = 'SELECT ID from tbl_clients where deleted = 0 AND email ="'.$email.'" LIMIT 1';
		$rowsClient = dbFunctions::getRowCount($query);
		if($rowsClient > 0){
			$query = 'UPDATE tbl_clients SET activation_key = "'.$activation_key.'" WHERE email = "'.$email.'"';
			return dbFunctions::executeQuery($query);
		}
	}
}

