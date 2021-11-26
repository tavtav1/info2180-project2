<?php
$id = '1';
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$password= $_POST['password'];
$email= $_POST['email'];

$password_digest = password_hash($password, PASSWORD_DEFAULT);
$date_joined = date("Y.m.d");


require_once 'dbconfig.php';
try{
	$conn = new PDO("mysql:host = $host; dbname=$dbname", $username,$password);
	echo ( "Connected to $dbname at $host successfully.");
	$conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		} catch (PDOException $pe) {
	    die("Could not connect to the database $dbname :" . $pe->getMessage());
	}

$insertData = "INSERT INTO Users(firstname,lastname,password,email,date_joined) VALUES('$fname','$lname','$password_digest','$email','$date_joined')";

$conn->exec($insertData);
