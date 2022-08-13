<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	if(isset($_POST['name'])) {
		$name= $_POST['name'];
		$occu= $_POST['occu'];
		$phone= $_POST['phone'];
		$email= $_POST['email'];
		$address= $_POST['address'];
		$dob= $_POST['dob'];
		$sql= "INSERT INTO `teacher` (`name`,`occupation`,`dob`,`phone`,`email`,`address`,`password`) VALUES ('$name','$occu','$dob','$phone','$email','$address','09876543')";
		$query = mysqli_query($conn, $sql);
		if($query) {
			echo 'Faculty Registration Successfull - Please Refresh the Page';
		}
		else {
			echo 'Error Registring Faculty';
		}
	}
}