<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rc'])) {
$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	if(isset($_POST['rcid'])) {
		$cid= $_POST['rcid'];
		$sql= "DELETE FROM `course` where `cid` = $cid";
		$query = mysqli_query($conn, $sql);
		if($query) {
			echo 'Course Deletion Successfull';
		}
		else {
			echo 'Error Deleting Course';
		}
	}
	$checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rf'])) {
$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	if(isset($_POST['rtid'])) {
		$tid= $_POST['rtid'];
		$sql= "DELETE FROM `teacher` where `tid` = $tid";
		$query = mysqli_query($conn, $sql);
		if($query) {
			echo 'Faculty Removed Successfully';
		}
		else {
			echo 'Error Removing Faculty';
		}
	}
	$checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['rs'])) {
$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	if(isset($_POST['rsid'])) {
		$sid= $_POST['rsid'];
		$sql= "DELETE FROM `student` where `sid` = $sid";
		$query = mysqli_query($conn, $sql);
		if($query) {
			echo 'Student Deletion Successfull';
		}
		else {
			echo 'Error Removing Student';
		}
	}
	$checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eas'])) {
$mysqli = new mysqli('localhost', 'root', '', 'educatra');

if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 
// SQL query to select data from database
$sql = " SELECT * FROM student ORDER BY `sid` ASC";
$result = $mysqli->query($sql);
$mysqli->close();
$checkone = 1;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eaf'])) {
$mysqli = new mysqli('localhost', 'root', '', 'educatra');

    if ($mysqli->connect_error) {
        die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
    }
     
    // SQL query to select data from database
    $sql = " SELECT * FROM teacher ORDER BY `tid` ASC";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 2;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eac'])) {
$mysqli = new mysqli('localhost', 'root', '', 'educatra');

if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 
// SQL query to select data from database
$sql = " SELECT * FROM course ORDER BY `cid` ASC";
$result = $mysqli->query($sql);
$mysqli->close();
$checkone = 3;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['msi'])) {
$mysqli = new mysqli('localhost', 'root', '', 'educatra');

    if ($mysqli->connect_error) {
        die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
    }
     
    // SQL query to select data from database
    $sql = " SELECT * FROM helpstd ORDER BY `helpid` ASC";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 4;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['helps'])) {
$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
        $helpid= $_POST['helpid'];
        $sql= "UPDATE helpstd SET status = 'Solved' where helpid=$helpid";
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo 'Marked Solved';
        }
        else {
            echo 'Error';
        }
    $checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mfi'])) {
$mysqli = new mysqli('localhost', 'root', '', 'educatra');

    if ($mysqli->connect_error) {
        die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
    }
     
    // SQL query to select data from database
    $sql = " SELECT * FROM helpfac ORDER BY `helpid` ASC";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 5;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['helpf'])) {
$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
        $helpid= $_POST['helpid'];
        $sql= "UPDATE helpfac SET status = 'Solved' where helpid=$helpid";
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo 'Marked Solved';
        }
        else {
            echo 'Error';
        }
    $checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mci'])) {
$mysqli = new mysqli('localhost', 'root', '', 'educatra');

    if ($mysqli->connect_error) {
        die('Connect Error (' .
        $mysqli->connect_errno . ') '.
        $mysqli->connect_error);
    }
     
    // SQL query to select data from database
    $sql = " SELECT * FROM helpprt ORDER BY `helpid` ASC";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 6;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['helpp'])) {
$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
        $helpid= $_POST['helpid'];
        $sql= "UPDATE helpprt SET status = 'Solved' where helpid=$helpid";
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo 'Marked Solved';
        }
        else {
            echo 'Error';
        }
    $checkone = 0;
}
?>

<?php

if ($checkone == "1") {
	// code...
?>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Admin Ops</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            font-size: xx-large;
            font-family: Calibri;
        }
 
        td {
            background-color: white;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
    </style>
</head>
<body style="background-color: #D6E4FF;">
    <section>
        <h1>All Registered Students</h1>
        <table>
            <tr>
                <th>S. ID</th>
                <th>P. ID</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Phone No.</th>
                <th>Email</th>
                <th>Address</th>
                <th>Password</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['sid'];?></td>
                <td><?php echo $rows['pid'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['dob'];?></td>
                <td><?php echo $rows['phone'];?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['address'];?></td>
                <td><?php echo $rows['password'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>
 
</html>
<?php
}
?>



<?php
if ($checkone == "2") 
{
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Ops</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            font-size: xx-large;
            font-family: Calibri;
        }
 
        td {
            background-color: white;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        td {
            font-weight: lighter;
        }
    </style>
</head> 
<body style="background-color: #D6E4FF;">
    <section>
        <h1>All Registered Faculty</h1>
        <table>
            <tr>
                <th>T. ID</th>
                <th>Name</th>
                <th>Occupation</th>
                <th>Date of Birth</th>
                <th>Phone No.</th>
                <th>Email</th>
                <th>Address</th>
                <th>Password</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['tid'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['occupation'];?></td>
                <td><?php echo $rows['dob'];?></td>
                <td><?php echo $rows['phone'];?></td>
                <td><?php echo $rows['email'];?></td>
                <td><?php echo $rows['address'];?></td>
                <td><?php echo $rows['password'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>
 
</html>
<?php
}
?>



<?php
if ($checkone == "3") 
{
?>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Admin Ops</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            font-size: xx-large;
            font-family: Calibri;
        }
 
        td {
            background-color: white;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
    </style>
</head> 
<body style="background-color: #D6E4FF;">
    <section>
        <h1>All Registered Courses</h1>
        <table>
            <tr>
                <th>C. ID</th>
                <th>Course Name</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['cid'];?></td>
                <td><?php echo $rows['name'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>
 
</html>
<?php
}
?>

<?php
if ($checkone == "4") 
{
?>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Admin Ops</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            font-size: xx-large;
            font-family: Calibri;
        }
 
        td {
            background-color: white;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
    </style>
</head> 
<body style="background-color: #D6E4FF;">
    <section>
        <h1>Student Help Center</h1>
        <table>
            <tr>
                <th>Help ID</th>
                <th>Student ID</th>
                <th>Issue</th>
                <th>Status</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['helpid'];?></td>
                <td><?php echo $rows['sid'];?></td>
                <td><?php echo $rows['issue'];?></td>
                <td><?php echo $rows['status'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
    <center>
        <h2>Mark Issue Resolved</h2>
    <form method="POST">
        <label for="helpid">Help ID: </label>
        <input type="number" name="helpid">
        <input type="submit" name="helps">
    </form>
</center>
</body>
 
</html>
<?php
}
?>

<?php
if ($checkone == "5") 
{
?>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Admin Ops</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            font-size: xx-large;
            font-family: Calibri;
        }
 
        td {
            background-color: white;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
    </style>
</head> 
<body style="background-color: #D6E4FF;">
    <section>
        <h1>Faculty Help Requests</h1>
        <table>
            <tr>
                <th>Help ID</th>
                <th>Faculty ID</th>
                <th>Issue</th>
                <th>Status</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['helpid'];?></td>
                <td><?php echo $rows['tid'];?></td>
                <td><?php echo $rows['issue'];?></td>
                <td><?php echo $rows['status'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
    <center>
        <h2>Mark Issue Resolved</h2>
    <form method="POST">
        <label for="helpid">Help ID: </label>
        <input type="number" name="helpid">
        <input type="submit" name="helpf">
    </form>
</center>
</body>
 
</html>
<?php
}
?>

<?php
if ($checkone == "6") 
{
?>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Admin Ops</title>
    <!-- CSS FOR STYLING THE PAGE -->
    <style>
        table {
            margin: 0 auto;
            font-size: large;
            border: 1px solid black;
        }
 
        h1 {
            text-align: center;
            font-size: xx-large;
            font-family: Calibri;
        }
 
        td {
            background-color: white;
            border: 1px solid black;
        }
 
        th,
        td {
            font-weight: bold;
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
 
        td {
            font-weight: lighter;
        }
    </style>
</head> 
<body style="background-color: #D6E4FF;">
    <section>
        <h1>Parent Help Requests</h1>
        <table>
            <tr>
                <th>Help ID</th>
                <th>Parent ID</th>
                <th>Issue</th>
                <th>Status</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['helpid'];?></td>
                <td><?php echo $rows['pid'];?></td>
                <td><?php echo $rows['issue'];?></td>
                <td><?php echo $rows['status'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
    <center>
        <h2>Mark Issue Resolved</h2>
    <form method="POST">
        <label for="helpid">Help ID: </label>
        <input type="number" name="helpid">
        <input type="submit" name="helpp">
    </form>
</center>
</body>
 
</html>
<?php
}
?>