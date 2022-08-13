<?php
$phone= $_POST["phone"];
$password= $_POST["password"];
session_start();
$_SESSION['phone']=$phone;

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$mysqli = new mysqli('localhost', 'root', '', 'educatra');

	if ($mysqli->connect_error) {
		die('Connect Error (' .
		$mysqli->connect_errno . ') '.
		$mysqli->connect_error);
	}

	$sqlOne = "SELECT * FROM student where `phone` = '$phone' and `password` = '$password'";  
	$resultOne = $mysqli->query($sqlOne);  
	$rowOne = mysqli_fetch_array($resultOne, MYSQLI_ASSOC);  
	$countOne = mysqli_num_rows($resultOne);  
	    
	$sqlTwo = "SELECT * FROM teacher where `phone` = '$phone' and `password` = '$password'";  
	$resultTwo = $mysqli->query($sqlTwo);  
	$rowTwo = mysqli_fetch_array($resultTwo, MYSQLI_ASSOC);  
	$countTwo = mysqli_num_rows($resultTwo);

	$sqlThree = "SELECT * FROM parent where `phone` = '$phone' and `password` = '$password'";  
	$resultThree = $mysqli->query($sqlThree);  
	$rowThree = mysqli_fetch_array($resultThree, MYSQLI_ASSOC);  
	$countThree = mysqli_num_rows($resultThree); 
	    
	$sqlFour = "SELECT * FROM admin where `phone` = '$phone' and `password` = '$password'";  
	$resultFour = $mysqli->query($sqlFour);  
	$rowFour = mysqli_fetch_array($resultFour, MYSQLI_ASSOC);  
	$countFour = mysqli_num_rows($resultFour);


	if($countOne == 1){  
	    echo "<h1><center> Student Login successful </center></h1>";
	    header("Location: http://localhost/lms/studentdash.html", TRUE, 301);
		exit();  
	}
	elseif($countTwo == 1){  
	    echo "<h1><center> Faculty Login successful </center></h1>";
	    header("Location: http://localhost/lms/facultydash.html", TRUE, 301);
		exit();  
	}
	elseif($countThree == 1){  
	    echo "<h1><center> Parent Login successful </center></h1>";
	    header("Location: http://localhost/lms/parentdash.html", TRUE, 301);
		exit();  
	}  
	elseif($countFour == 1){
	    echo "<h1><center> Admin Login successful </center></h1>";
	    header("Location: http://localhost/lms/admindash.html", TRUE, 301);
		exit();  
	}  
	else{  
	    echo "<h1> Login failed. Invalid username or password.</h1>";
	}
}

?>