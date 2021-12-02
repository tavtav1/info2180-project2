<?php
include('session.php');

$title = $_POST['title'];
$desc = $_POST['desc'];
$assign= $_POST['assign'];
$type= $_POST['type'];
$priority= $_POST['priority'];
$status = "Open";
$created = date("Y.m.d");
$updated = date("Y.m.d");

$titleErr = $descErr = $assignErr = $typeErr= $priorityErr="";

// DECLARE ARRAY TO STORE ERRORS
$err = array();

// NESTED-IF STATEMENT TO PERFORM VALIDATION OF DATA  
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	try {
		// CHECKS IF FIELD IS EMPTY
		if (empty($_POST["title"])) 
		{
			// INSERTS ERROR INTO ARRRAY
			array_push($err, $titleErr);
		}

		// CHECKS IF FIELD IS EMPTY
	  	if (empty($_POST["desc"])) 
	  	{
			// INSERTS ERROR INTO ARRRAY
			array_push($err, $descErr);
		}

		// CHECKS IF FIELD IS EMPTY
	    if (empty($_POST["assign"]))
	    {
			// INSERTS ERROR INTO ARRRAY
			array_push($err, $assignErr);
		}

		// CHECKS IF FIELD IS EMPTY
	    if (empty($_POST["type"])) 
	    {
			// INSERTS ERROR INTO ARRRAY
			array_push($err, $typeErr);
		}

		// CHECKS IF FIELD IS EMPTY
	    if (empty($_POST["priority"])) 
	    {
			// INSERTS ERROR INTO ARRRAY
			array_push($err, $priorityErr);
		}}

		catch ( \Exception $e) {
		header( "Location: register.html");
	}
}	

// CHECKS ERROR ARRAY AND IF EMPTY CONNECTS TO DATABASE
if (sizeof($err)==0) {
	require_once 'dbconfig.php';
	try{
		$conn = new PDO("mysql:host = $host; dbname=$dbname", $username,$password);
		header( "Location: register.html");
		$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			} catch (PDOException $pe) {
		    die("Could not connect to the database $dbname :" . $pe->getMessage());
		}
	$current= $_SESSION['login_user'];
	 $result = $conn -> prepare("SELECT * FROM Users WHERE email = '$current');
	 $result -> execute();
	$users = $result-> fetchAll();


	$id = Users['id'];
	$insertData = "INSERT INTO Issues(id,title,description,type,priority,status,assigned_to,created_by,created,updated) VALUES('$id','$title','$desc','$type','$priority','$status','$assign','$created_by','$created','$updated');

	$conn->exec($insertData);
}

