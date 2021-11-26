<?php

require_once "dbconfig.php";
require_once "session.php";
$count = 0;
 if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 

      $email = $_POST['email'];
      $_password =$_POST['password'];
      $password_digest = password_hash($_password, PASSWORD_DEFAULT);
      $pass_verify= password_verify($_password, $password_digest);
try{
 	$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	    $conn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
      // CATCHES ERRORS AND PRINTS FAILURE MESSAGE
	} catch (PDOException $pe) {
    die("Could not connect to the database $dbname :" . $pe->getMessage());
	}
	if ( password_verify($_password, $password_digest)){
		 $ses_sql ="SELECT email FROM Users WHERE email = '$email'";
   		$statement = $conn->prepare($ses_sql);
   		$statement->execute(array('email'=> $_POST["email"],'password'=>$_POST["password"]));
      
	}
     
      $count = $statement -> rowCount();
		
      if($count > 0) {
        $_SESSION['login_user'] = $email; 
        header( "Location: register.html");
      }else {
         $error = "Your Login Name or Password is invalid";
         echo nl2br ("$error \r\n");
      }
}