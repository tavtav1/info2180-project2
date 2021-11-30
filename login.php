<?php

require_once "dbconfig.php";
require_once "session.php";
$count = 0;
 if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

      $email = $_POST['email'];
      $_password =$_POST['password'];
try{
 	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	    $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      // CATCHES ERRORS AND PRINTS FAILURE MESSAGE
	} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
	}
    $result = $conn-> prepare("SELECT * FROM Users WHERE email = '$email'");

    $result -> execute(array('email'=> $_POST["email"]));

    $row = $result->fetch(PDO::FETCH_ASSOC);
    if(is_array($row))
    {
        if ( password_verify($_password,$row['password'])){
            $_SESSION['login_user'] = $email; 
            header( "Location: register.html");
          }else {
             $error = "Your Login Name or Password is invalid";
             echo nl2br ("$error \r\n");
          }
    }
}