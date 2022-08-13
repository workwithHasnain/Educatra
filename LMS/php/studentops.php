<?php

$mysqli = new mysqli('localhost', 'root', '', 'educatra');

if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
session_start();
$checkone=0;
$phone=$_SESSION['phone'];
$classid;

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hd'])) {
    // SQL query to select data from database
    $sql = " SELECT * FROM helpstd where sid = (select sid from student where phone = $phone) ORDER BY `helpid` ASC";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 7;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mp'])) {
    // SQL query to select data from database
    $sql = " SELECT * FROM student where sid = (select sid from student where phone = $phone)";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 8;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['helpf'])) {
$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
        $issue= $_POST['issue'];
        $sql= "INSERT INTO helpstd (sid,issue) VALUES ((select sid from student where phone = $phone),'$issue')";
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo 'Sent Successfully';
        }
        else {
            echo 'Error';
        }
    $checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['jcsubmit'])) {
	$classid= $_POST['classid'];
	$password= $_POST["password"];
	$sqlOne = "SELECT * FROM class where `classid` = '$classid' and `password` = '$password'";  
	$resultOne = $mysqli->query($sqlOne);  
	$rowOne = mysqli_fetch_array($resultOne, MYSQLI_ASSOC);  
	$countOne = mysqli_num_rows($resultOne);
	if($countOne == 1){  
	    $conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	    // SQL query to select data from database
	    $sql= "INSERT INTO `studying` (`sid`,`classid`) VALUES ((SELECT sid from student where phone = 
	    	$phone),$classid)";
	    $query = mysqli_query($conn, $sql);
	    $sqltwo= "INSERT INTO `grade` (`sid`,`classid`) VALUES ((SELECT sid from student where phone = 
	    	$phone),$classid)";
	    $querytwo = mysqli_query($conn, $sqltwo);
	    if($query and $querytwo) {
	        echo "<h1><center>Successfully Enrolled in Class: $classid</center></h1>";
	    }
	    else {
	        echo '<h1><center>Error: Enrollment Failed</center></h1>';
	    } 
	}
	else{
		echo '<h1><center>Error: Wrong Class Password</center></h1>';
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['asubmit'])) {
	$classid= $_POST['classid'];
	$sqlOne = "SELECT * FROM studying where `classid` = '$classid' and `sid` = (SELECT sid from student where phone = $phone)";  
	$resultOne = $mysqli->query($sqlOne);  
	$rowOne = mysqli_fetch_array($resultOne, MYSQLI_ASSOC);  
	$countOne = mysqli_num_rows($resultOne);
	if($countOne == 1){  
	   $sql = "SELECT assignmentid as aid, title, (select name from course where cid = (select cid from class where classid=$classid)) as course, dateassigned,lastdate,(select link from studentassignment where assignmentid=aid) as sub,(select datesub from studentassignment where assignmentid=assignment.assignmentid and sid =(select sid from student where phone = $phone)) as subdate,(select marks from studentassignment where sid = (select sid from student where phone = $phone)and assignmentid=assignment.assignmentid) as marks,(select totalmarks from assignment where assignmentid=aid) as totalm from assignment where classid = $classid order by aid ASC";
		$result = $mysqli->query($sql);
		$mysqli->close();
		$checkone = 1;  
	}
	else{
		echo "<h1><center>You are Not Enrolled in Class $classid</center></h1>";
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assubmit'])) {
	$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	$aid= $_POST['aid'];
	$sub= $_POST['sub'];
	// SQL query to select data from database
	$sql= "INSERT INTO studentassignment (sid,assignmentid,link) VALUES ((SELECT sid from student where phone=$phone),$aid,'$sub')";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo '<h1><center>Assignment Submitted Successfully</center></h1>';
	}
	else {
		echo '<h1><center>Error Submitting Assignment</center></h1>';
	}
	$checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mc'])) {
// SQL query to select data from database
	$sql = "SELECT classid as clid,(select name from course where cid = (select cid from class where classid=clid))as course,(select name from teacher where tid = (select tid from class where classid=clid)) as ins from studying where sid = (select sid from student where phone = $phone)";
	$result = $mysqli->query($sql);
	$mysqli->close();
	$checkone = 2;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mg'])) {
// SQL query to select data from database
	$sql = "SELECT classid as clid, sid, (select name from student where sid =(select sid from student where phone =$phone)) as name,(select cid from class where classid=clid) as crsid,(select name from course where cid =crsid) as crname,fmid,smid,final,sess,year from grade where sid = (select sid from student where phone =$phone)";
	$result = $mysqli->query($sql);
	$mysqli->close();
	$checkone = 3;
} 

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['chat'])) {
// SQL query to select data from database
	$sql = "SELECT sender, message from chat where receiver = (select sid from student where phone = $phone)";
	$result = $mysqli->query($sql);
	$mysqli->close();
	$checkone = 4;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sent'])) {
// SQL query to select data from database
	$sql = "SELECT receiver, message from chat where sender = (select sid from student where phone = $phone)";
	$result = $mysqli->query($sql);
	$mysqli->close();
	$checkone = 5;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cm'])) {
	$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	$to= $_POST['to'];
	$mess= $_POST['mess'];
	// SQL query to select data from database
	$sql= "INSERT INTO chat (sender,receiver,message) VALUES ((SELECT sid from student where phone=$phone),$to,'$mess')";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo '<h1><center>Message Sent Successfully</center></h1>';
	}
	else {
		echo '<h1><center>Sent Fail</center></h1>';
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
    <title>Student Ops</title>
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
        <h1>All Your Assignments for the Selected Class</h1>
        <table>
            <tr>
            	<th>A. ID</th>
            	<th>Title</th>
                <th>Course</th>
                <th>Date Assigned</th>
                <th>Due Date</th>
                <th>Submission</th>
                <th>Date Submitted</th>
                <th>Marks</th>
                <th>Total Marks</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
            	<td><?php echo $rows['aid'];?></td>
            	<td><?php echo $rows['title'];?></td>
                <td><?php echo $rows['course'];?></td>
                <td><?php echo $rows['dateassigned'];?></td>
            	<td><?php echo $rows['lastdate'];?></td>
                <td><?php echo $rows['sub'];?></td>
            	<td><?php echo $rows['subdate'];?></td>
            	<td><?php echo $rows['marks'];?></td>
            	<td><?php echo $rows['totalm'];?></td>
            <tr>
            <?php
                }
            ?>
        </table>
    </section>
    <h3>Add Submission</h3>
    <form method="POST">
        <label for="aid" style="font-size: 20px;"><b>A. ID:</b></label>
        <input required type="number" name="aid" style="font-size: 20px;"><br><br>
        
        <label for="sub" style="font-size: 20px;"><b>Submission:</b></label>
        <input required type="text" name="sub" style="font-size: 20px;"><br><br>

        <input type="submit" name="assubmit" value="Submit" style="font-size: 20px;">
</form>
</body>
</html>
<?php
}
?>



<?php
if ($checkone == "2") {
	// code...
?>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Student Ops</title>
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
        <h1>All Your Enrolled Classes</h1>
        <table>
            <tr>
            	<th>Class. ID</th>
            	<th>Course</th>
                <th>Instructor</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
            	<td><?php echo $rows['clid'];?></td>
            	<td><?php echo $rows['course'];?></td>
                <td><?php echo $rows['ins'];?></td>
            <tr>
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
if ($checkone == "3") {
	// code...
?>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Student Ops</title>
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
        <h1>Grades</h1>
        <table>
            <tr>
            	<th>Class. ID</th>
            	<th>S. ID</th>
                <th>S. Name</th>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>First Mid</th>
                <th>Second Mid</th>
                <th>Finals</th>
                <th>Sessionals</th>
                <th>Grading Year</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
            	<td><?php echo $rows['clid'];?></td>
            	<td><?php echo $rows['sid'];?></td>
                <td><?php echo $rows['name'];?></td>
            	<td><?php echo $rows['crsid'];?></td>
                <td><?php echo $rows['crname'];?></td>
            	<td><?php echo $rows['fmid'];?></td>
                <td><?php echo $rows['smid'];?></td>
            	<td><?php echo $rows['final'];?></td>
                <td><?php echo $rows['sess'];?></td>
            	<td><?php echo $rows['year'];?></td>
            <tr>
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
if ($checkone == "4") {
	// code...
?>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Student Ops</title>
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
	<h2>Create Message</h2>
	<form method="POST">
		<label for="to" style="font-size: 20px;"><b>To:</b></label><br>
		<input type="number" name="to" style="font-size: 20px; width: 15%;"><br>
		<label for="mess" style="font-size: 20px;"><b>Message:</b></label><br>
		<input type="text" name="mess" style="font-size: 20px; height: 20%;"><br>
		<input type="submit" name="cm" value="Send" style="font-size: 20px;"><br><br>
	</form>
    <section>
        <h1>Received Messages</h1>
        <table>
            <tr>
            	<th>From</th>
            	<th>Message</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
            	<td><?php echo $rows['sender'];?></td>
            	<td><?php echo $rows['message'];?></td>
            <tr>
            <?php
                }
            ?>
        </table>
    </section>
    <form method="POST">
    	<input type="submit" value="Sent Messages" name="sent" style="font-size: 15px;">
    </form>
</body>
</html>
<?php
}
?>

<?php
if ($checkone == "5") {
	// code...
?>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Student Ops</title>
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
        <h1>Sent Messages</h1>
        <table>
            <tr>
            	<th>To</th>
            	<th>Message</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
            	<td><?php echo $rows['receiver'];?></td>
            	<td><?php echo $rows['message'];?></td>
            <tr>
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
if ($checkone == "7") 
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
        <h1>Your Help Requests</h1>
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
        <h2>Send New Request</h2>
        <pre>Explain the issue in the given box below.</pre>
    <form method="POST">
        <label for="issue">Issue: </label>
        <input type="text" name="issue" style="height: 20%;">
        <input type="submit" name="helpf">
    </form>
</center>
</body>
 
</html>
<?php
}
?>

<?php

if ($checkone == "8") {
    // code...
?>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <title>Faculty Ops</title>
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
        <h1>Your Profile</h1>
        <table>
            <tr>
                <th>Student ID</th>
                <th>Parent ID</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Phone No.</th>
                <th>Email Address</th>
                <th>Address</th>
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
            <tr>
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