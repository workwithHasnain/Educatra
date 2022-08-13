<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	if(isset($_POST['name'])) {
		$name= $_POST['name'];
		$sql= "INSERT INTO `course` (`name`) VALUES ('$name')";
		$query = mysqli_query($conn, $sql);
		if($query) {
			echo 'Course Registration Successfull - Please Refresh the Page';
		}
		else {
			echo 'Error Registring Course';
		}
	}
}