<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	if(isset($_POST['name'])) {
		$name= $_POST['name'];
		$phone= $_POST['phone'];
		$email= $_POST['email'];
		$address= $_POST['address'];
		$dob= $_POST['dob'];
		$pid= $_POST['pid'];
		$sql= "INSERT INTO `student` (`name`,`pid`,`dob`,`phone`,`email`,`address`,`password`) VALUES ('$name','$pid','$dob','$phone','$email','$address','12345678')";
		$query = mysqli_query($conn, $sql);
		if($query) {
			echo 'Student Registration Successfull - Please Refresh the Page';
		}
		else {
			echo 'Error Registring Student';
		}
	}
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ssid'])){
	$mysqli = new mysqli('localhost', 'root', '', 'educatra');
	$sid= $_POST['sid'];
	if ($mysqli->connect_error) {
	    die('Connect Error (' .
	    $mysqli->connect_errno . ') '.
	    $mysqli->connect_error);
	} 
	$sql3 = " SELECT pid FROM student where sid = $sid ";
	$result = $mysqli->query($sql3);
	$mysqli->close();

?>
	<html>
	<body>
	    <section>
	        <table style="border: 1px solid black;">
	            <tr>
	                <th>PID</th>
	            </tr>
	            <?php
	                while($rows=$result->fetch_assoc())
	                {
	            ?>
	            <tr>
	                <td><?php echo $rows['pid'];?></td>
	            </tr>
	            <?php
	                }
	            ?>
	        </table>
	    </section>
	</body>
	<a href="http://localhost/lms/addstd.html#addstd"><button>Back</button></a>
	</html>
<?php
	}
?>