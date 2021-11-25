<?php
if(isset($_POST['submit_form']))
{
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$password= $_POST['password'];
	$email= $_POST['email'];

	$password_digest = password_hash($password, PASSWORD_DEFAULT);
	$date_joined = date("Y.m.d");

	$connect = new PDO('mysql:host = localhost; dbname= bugme;', 'root','');
	$insertData = "INSERT INTO Users(firstname,lastname,password,email,date_joined) VALUES('$fname','$lname','$password','$email','$date_joined')";
	$stmt = $connect->query($insertData);
	
}