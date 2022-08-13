<?php 
$mysqli = new mysqli('localhost', 'root', '', 'educatra');

if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
session_start();
$phone = $_SESSION['phone'];


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hd'])) {
    // SQL query to select data from database
    $sql = " SELECT * FROM helpfac where tid =(select tid from teacher where phone = $phone)  ORDER BY `helpid` ASC";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 7;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mp'])) {
    // SQL query to select data from database
    $sql = " SELECT * FROM teacher where tid = (select tid from teacher where phone = $phone)";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 8;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['helpf'])) {
$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
        $issue= $_POST['issue'];
        $sql= "INSERT INTO helpfac (tid,issue) VALUES ((select tid from teacher where phone = $phone),'$issue')";
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo 'Sent Successfully';
        }
        else {
            echo 'Error';
        }
    $checkone = 0;
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eac'])) {
// SQL query to select data from database
$sql = "SELECT classid, cid, name, password from class natural join course where tid = (select tid from teacher where phone = $phone) ORDER BY `classid` ASC";
$result = $mysqli->query($sql);
$mysqli->close();
$checkone = 1;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eaasubmit'])) {
	$classid= $_POST['classid'];
// SQL query to select data from database
	$sql = "SELECT assignmentid, title, totalmarks, classid, (select name from course where cid = (select cid from class where classid=$classid)) as name, dateassigned, lastdate from assignment where classid = $classid ORDER BY `assignmentid` ASC;";
	$result = $mysqli->query($sql);
	$mysqli->close();
	$checkone = 2;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eassubmit'])) {
	$classid= $_POST['classid'];
// SQL query to select data from database
	$sql = "SELECT classid, sid, name, (select cid from class where classid=$classid) as cid,(select name from course where cid = (select cid from class where classid = $classid)) as cname, email from studying natural join student where studying.classid=$classid ORDER BY `sid` ASC";
	$result = $mysqli->query($sql);
	$mysqli->close();
	$checkone = 3;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vgsubmit'])) {
// SQL query to select data from database
    $classid= $_POST['classid'];
    $globalclassid = $classid;
    $sql = "SELECT sid, student.name as name, (select cid from class where classid=$classid) as cid, (select name from class natural join course where classid = $classid) as cname, fmid, smid, final, sess, year from grade natural join student where classid=$classid";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 4;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sssubmit'])) {
// SQL query to select data from database
    $classid= $_POST['classid'];
    $sql = "SELECT sid, student.name as name, assignmentid,title,link, dateassigned, datesub, lastdate, concat(marks,'/', totalmarks) as marks from (assignment natural join studentassignment) natural join student where classid=$classid order by sid ASC";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 5;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['feedb'])) {
// SQL query to select data from database
$sql = "SELECT fbid,sid,name,remarks,date,reply from feedbackft natural join student where tid=(select tid from teacher where phone = $phone) ORDER BY fbid ASC;";
$result = $mysqli->query($sql);
$mysqli->close();
$checkone = 6;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gasubmit'])) {
    $conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
    $sid= $_POST['sid'];
    $aid= $_POST['aid'];
    $marks= $_POST['marks'];
    // SQL query to select data from database
    $sql= "UPDATE studentassignment SET marks = $marks WHERE sid = $sid and assignmentid = $aid";
    $query = mysqli_query($conn, $sql);
    if($query) {
        echo '<h1><center>Assignment Marked Successfully - Reload</center></h1>';
    }
    else {
        echo '<h1><center>Error Marking Assignment</center></h1>';
    }
    $checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fbsend'])) {
    $conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
    $sid= $_POST['sid'];
    $remarks= $_POST['remarks'];
    // SQL query to select data from database
    $sql= "INSERT INTO `feedbackft` (`sid`,`tid`,`remarks`) VALUES ('$sid',(select tid from teacher where phone = $phone),'$remarks')";
    $query = mysqli_query($conn, $sql);
    if($query) {
        echo '<h1><center>Feedback Sent Successfully - Reload</center></h1>';
    }
    else {
        echo '<h1><center>Error Sending Feedback</center></h1>';
    }
    $checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fmsubmit'])) {
    $conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
    $sid= $_POST['sid'];
    $classid= $_POST['classid'];
    $fmid= $_POST['fmid'];
    // SQL query to select data from database
    $sql= "UPDATE grade SET fmid = $fmid WHERE sid = $sid and classid = $classid";
    $query = mysqli_query($conn, $sql);
    if($query) {
        echo '<h1><center>First Mid Marked Successfully for Selected SID</center></h1>';
    }
    else {
        echo '<h1><center>Error Marking Grade</center></h1>';
    }
    $checkone = 0;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['smsubmit'])) {
    $conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
    $sid= $_POST['sid'];
    $classid= $_POST['classid'];
    $smid= $_POST['smid'];
    // SQL query to select data from database
    $sql= "UPDATE grade SET smid = $smid WHERE sid = $sid and classid = $classid";
    $query = mysqli_query($conn, $sql);
    if($query) {
        echo '<h1><center>Second Mid Marked Successfully for Selected SID</center></h1>';
    }
    else {
        echo '<h1><center>Error Marking Grade</center></h1>';
    }
    $checkone = 0;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fsubmit'])) {
    $conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
    $sid= $_POST['sid'];
    $classid= $_POST['classid'];
    $final= $_POST['final'];
    // SQL query to select data from database
    $sql= "UPDATE grade SET final = $final WHERE sid = $sid and classid = $classid";
    $query = mysqli_query($conn, $sql);
    if($query) {
        echo '<h1><center>Finals Marked Successfully for Selected SID</center></h1>';
    }
    else {
        echo '<h1><center>Error Marking Grade</center></h1>';
    }
    $checkone = 0;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sesssubmit'])) {
    $conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
    $sid= $_POST['sid'];
    $classid= $_POST['classid'];
    $sess= $_POST['sess'];
    // SQL query to select data from database
    $sql= "UPDATE grade SET sess = $sess WHERE sid = $sid and classid = $classid";
    $query = mysqli_query($conn, $sql);
    if($query) {
        echo '<h1><center>Sessionals Mid Marked Successfully for Selected SID</center></h1>';
    }
    else {
        echo '<h1><center>Error Marking Grade</center></h1>';
    }
    $checkone = 0;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ysubmit'])) {
    $conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
    $sid= $_POST['sid'];
    $classid= $_POST['classid'];
    $year= $_POST['year'];
    // SQL query to select data from database
    $sql= "UPDATE grade SET year = $year WHERE sid = $sid and classid = $classid";
    $query = mysqli_query($conn, $sql);
    if($query) {
        echo '<h1><center>Grading Year Successfully Submitted for Selected SID</center></h1>';
    }
    else {
        echo '<h1><center>Error Submitting Grading Year</center></h1>';
    }
    $checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['casubmit'])) {
	$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	$title= $_POST['title'];
	$marks= $_POST['marks'];
	$ld= $_POST['ld'];
	$classid= $_POST['classid'];
	// SQL query to select data from database
	$sql= "INSERT INTO `assignment` (`title`,`totalmarks`,`classid`,`lastdate`) VALUES ('$title','$marks','$classid','$ld')";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo '<h1><center>Assignment Creation Successfull</center></h1>';
	}
	else {
		echo '<h1><center>Error Creating Assignment</center></h1>';
	}
	$checkone = 0;
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ccsubmit'])) {
	$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	$password= $_POST['password'];
	$cid= $_POST['cid'];
	// SQL query to select data from database
	$sql= "INSERT INTO `class` (`tid`,`cid`,`password`) VALUES ((select tid from teacher where phone = $phone),'$cid','$password')";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo '<h1><center>Class Creation Successfull</center></h1>';
	}
	else {
		echo '<h1><center>Error Creating Class</center></h1>';
	}
	$checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remasubmit'])) {
	$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	$assignmentid= $_POST['assignmentid'];
	// SQL query to select data from database
	$sql= "DELETE from `assignment` where assignmentid = $assignmentid";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo '<h1><center>Assignment Deletion Successfull</center></h1>';
	}
	else {
		echo '<h1><center>Error Deleting Assignment</center></h1>';
	}
	$checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remcsubmit'])) {
	$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
	$classid= $_POST['classid'];
	// SQL query to select data from database
	$sql= "DELETE from `class` where classid = $classid";
	$query = mysqli_query($conn, $sql);
	if($query) {
		echo '<h1><center>Class Deletion Successfull</center></h1>';
	}
	else {
		echo '<h1><center>Error Deleting Class</center></h1>';
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
        <h1>All Your Classes</h1>
        <table>
            <tr>
                <th>Class ID</th>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Class Password</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['classid'];?></td>
                <td><?php echo $rows['cid'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['password'];?></td>
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
if ($checkone == "2") {
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
        <h1>All Your Assignments for the Selected Class</h1>
        <table>
            <tr>
            	<th>Assignment ID</th>
            	<th>Title</th>
            	<th>Total Marks</th>
                <th>Class ID</th>
                <th>Course Name</th>
                <th>Date Assigned</th>
                <th>Last Date</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
            	<td><?php echo $rows['assignmentid'];?></td>
            	<td><?php echo $rows['title'];?></td>
            	<td><?php echo $rows['totalmarks'];?></td>
                <td><?php echo $rows['classid'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['dateassigned'];?></td>
                <td><?php echo $rows['lastdate'];?></td>
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
        <h1>All Enrolled Students in the Selected Class</h1>
        <table>
            <tr>
                <th>Class ID</th>
                <th>S. ID</th>
                <th>Student Name</th>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Email</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['classid'];?></td>
                <td><?php echo $rows['sid'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['cid'];?></td>
                <td><?php echo $rows['cname'];?></td>
                <td><?php echo $rows['email'];?></td>
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

<h2>Upload Grades</h2>
    <form method="POST">
        <label for="sid" style="font-size: 20px;"><b>S. ID:</b></label>
        <input required type="number" name="sid" style="font-size: 20px;"><br><br>
        <label for="classid" style="font-size: 20px;"><b>Class. ID:</b></label>
        <input required type="number" name="classid" style="font-size: 20px;"><br><br>
        
        <label for="fmid" style="font-size: 20px;"><b>First Mid:</b></label>
        <input type="number" name="fmid" style="font-size: 20px;">
        <input type="submit" name="fmsubmit" style="font-size: 20px;"><br><br>
        
        <label for="smid" style="font-size: 20px;"><b>Second Mid:</b></label>
        <input type="number" name="smid" style="font-size: 20px;">
        <input type="submit" name="smsubmit" style="font-size: 20px;"><br><br>

        <label for="final" style="font-size: 20px;"><b>Final:</b></label>
        <input type="number" name="final" style="font-size: 20px;">
        <input type="submit" name="fsubmit" style="font-size: 20px;"><br><br>

        <label for="sess" style="font-size: 20px;"><b>Sessionals:</b></label>
        <input type="number" name="sess" style="font-size: 20px;">
        <input type="submit" name="sesssubmit" style="font-size: 20px;"><br><br>

        <label for="year" style="font-size: 20px;"><b>Year:</b></label>
        <input type="number" name="year" style="font-size: 20px;">
        <input type="submit" name="ysubmit" style="font-size: 20px;"><br><br>
</form>

    <section>
        <h1>Student Grades in the Selected Class</h1>
        <table>
            <tr>
                <th>S. ID</th>
                <th>Student Name</th>
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
                <td><?php echo $rows['sid'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['cid'];?></td>
                <td><?php echo $rows['cname'];?></td>
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

if ($checkone == "5") {
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
        <h1>Assignment Submissions</h1>
        <table>
            <tr>
                <th>S. ID</th>
                <th>S. Name</th>
                <th>A. ID</th>
                <th>Title</th>
                <th>Submission</th>
                <th>Assigned Date</th>
                <th>Submission Date</th>
                <th>Last Date</th>
                <th>Marks</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['sid'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['assignmentid'];?></td>
                <td><?php echo $rows['title'];?></td>
                <td><?php echo $rows['link'];?></td>
                <td><?php echo $rows['dateassigned'];?></td>
                <td><?php echo $rows['datesub'];?></td>
                <td><?php echo $rows['lastdate'];?></td>
                <td><?php echo $rows['marks'];?></td>
            <tr>
            <?php
                }
            ?>
        </table>
    </section>
     <!-- style="position: absolute; top: 23%; left: 73%; display: none"; -->
    <br><h3>Grade Assignment</h3>
    <form method="POST">
        <label for="aid" style="font-size: 20px;"><b>A. ID:</b></label>
        <input required type="number" name="aid" style="font-size: 20px;"><br><br>
        
        <label for="sid" style="font-size: 20px;"><b>S. ID:</b></label>
        <input required type="number" name="sid" style="font-size: 20px;"><br><br>
        
        <label for="marks" style="font-size: 20px;"><b>Marks:</b></label>
        <input required type="number" name="marks" style="font-size: 20px;"><br><br>

        <input type="submit" name="gasubmit" value="Proceed" style="font-size: 20px;">
</form>
</body>
</html>
<?php
}
?>


<?php

if ($checkone == "6") {
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
    <h3>Send New Feedback</h3>
    <form method="POST">
        <label for="sid" style="font-size: 20px;"><b>S. ID:</b></label>
        <input required type="number" name="sid" style="font-size: 20px;"><br><br>
        
        <label for="remarks" style="font-size: 20px;"><b>Feedback:</b></label>
        <input required type="text" name="remarks" style="font-size: 20px; height: 20%;"><br><br>

        <input type="submit" name="fbsend" value="Send" style="font-size: 20px;">
</form>
    <section>
        <h1>Feedbacks Sent by You</h1>
        <table>
            <tr>
                <th>FB. ID</th>
                <th>S. ID</th>
                <th>S. Name</th>
                <th>Feedback</th>
                <th>Date</th>
                <th>Reply</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['fbid'];?></td>
                <td><?php echo $rows['sid'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['remarks'];?></td>
                <td><?php echo $rows['date'];?></td>
                <td><?php echo $rows['reply'];?></td>
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
                <th>Faculty ID</th>
                <th>Name</th>
                <th>Occupation</th>
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
                <td><?php echo $rows['tid'];?></td>
                <td><?php echo $rows['name'];?></td>
                <td><?php echo $rows['occupation'];?></td>
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