<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
		if(isset($_POST['name'])) {
			$name= $_POST['name'];
			$phone= $_POST['phone'];
			$email= $_POST['email'];
			$address= $_POST['address'];
			$sql= "INSERT INTO `parent` (`name`,`phone`,`address`,`email`,`password`) VALUES ('$name','$phone','$address','$email','00001234')";
			$query = mysqli_query($conn, $sql);
			if($query) {
				echo 'Parent Registration Successfull - Please Click BACK to Continue Student Registration with below PID';
			}
			else {
				echo 'Error Registring Parent';
			}
		}
	}
$mysqli = new mysqli('localhost', 'root', '', 'educatra');
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
} 
$sql = " SELECT pid FROM parent where phone = $phone ";
$result = $mysqli->query($sql);
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
</html>