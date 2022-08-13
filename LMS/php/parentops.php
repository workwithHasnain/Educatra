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

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hd'])) {
    // SQL query to select data from database
    $sql = " SELECT * FROM helpprt where pid = (select pid from parent where phone = $phone) ORDER BY `helpid` ASC";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 7;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mp'])) {
    // SQL query to select data from database
    $sql = " SELECT * FROM parent where pid = (select pid from parent where phone = $phone)";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 8;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['helpf'])) {
$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
        $issue= $_POST['issue'];
        $sql= "INSERT INTO helpprt (pid,issue) VALUES ((select pid from parent where phone = $phone),'$issue')";
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo 'Sent Successfully';
        }
        else {
            echo 'Error';
        }
    $checkone = 0;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send'])) {
$conn= mysqli_connect('localhost', 'root', '', 'educatra') or die("Connection Failed:" .mysqli_connect_error());
        $fbid= $_POST['fbid'];
        $rep= $_POST['rep'];
        $sql= "UPDATE feedbackft SET reply = '$rep' where fbid = $fbid";
        $query = mysqli_query($conn, $sql);
        if($query) {
            echo 'Sent Successfully';
        }
        else {
            echo 'Error';
        }
    $checkone = 0;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['asubmit'])) {
    $classid= $_POST['classid'];
    $sid= $_POST['sid'];
    $sqlOne = "SELECT * FROM student where sid = $sid and pid = (SELECT pid from parent where phone = $phone)";  
    $resultOne = $mysqli->query($sqlOne);  
    $rowOne = mysqli_fetch_array($resultOne, MYSQLI_ASSOC);  
    $countOne = mysqli_num_rows($resultOne);
    if($countOne == 1){ 
        $sqlOne = "SELECT * FROM studying where `classid` = '$classid' and `sid` = $sid";  
        $resultOne = $mysqli->query($sqlOne);  
        $rowOne = mysqli_fetch_array($resultOne, MYSQLI_ASSOC);  
        $countOne = mysqli_num_rows($resultOne);
        if($countOne == 1){  
           $sql = "SELECT assignmentid as aid, title, (select name from course where cid = (select cid from class where classid=$classid)) as course, dateassigned,lastdate,(select link from studentassignment where assignmentid=aid) as sub,(select datesub from studentassignment where assignmentid=assignment.assignmentid and sid =$sid) as subdate,(select marks from studentassignment where sid = $sid and assignmentid=assignment.assignmentid) as marks,(select totalmarks from assignment where assignmentid=aid) as totalm from assignment where classid = $classid order by aid ASC";
            $result = $mysqli->query($sql);
            $mysqli->close();
            $checkone = 1;  
        }
        else{
            echo "<h1><center>Your Child is Not Enrolled in this Class $classid</center></h1>";
        }
    }
    else{
        echo "<h1><center>Please Enter Correct SID</center></h1>";
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['gsubmit'])) {
    $sid= $_POST['sid'];
    $sqlOne = "SELECT * FROM student where sid = $sid and pid = (SELECT pid from parent where phone = $phone)";  
    $resultOne = $mysqli->query($sqlOne);  
    $rowOne = mysqli_fetch_array($resultOne, MYSQLI_ASSOC);  
    $countOne = mysqli_num_rows($resultOne);
    if($countOne == 1){  
       $sql = "SELECT classid as clid, sid, (select name from student where sid =$sid) as name,(select cid from class where classid=clid) as crsid,(select name from course where cid =crsid) as crname,fmid,smid,final,sess,year from grade where sid = $sid";
        $result = $mysqli->query($sql);
        $mysqli->close();
        $checkone = 4;  
    }
    else{
        echo "<h1><center>Please Enter Correct SID</center></h1>";
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mcp'])) {
// SQL query to select data from database
    $sql = "SELECT * from student where pid = (select pid from parent where phone = $phone)";
    $result = $mysqli->query($sql);
    $mysqli->close();
    $checkone = 2;
}
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mcc'])) {
// SQL query to select data from database
    $sid= $_POST['sid'];
    $sqlOne = "SELECT * FROM student where sid = $sid and pid = (SELECT pid from parent where phone = $phone)";  
    $resultOne = $mysqli->query($sqlOne);  
    $rowOne = mysqli_fetch_array($resultOne, MYSQLI_ASSOC);  
    $countOne = mysqli_num_rows($resultOne);
    if($countOne == 1){ 
        $sql = "SELECT classid as clid,(select name from course where cid = (select cid from class where classid=clid))as course,(select name from teacher where tid = (select tid from class where classid=clid)) as ins from studying where sid = $sid";
        $result = $mysqli->query($sql);
        $mysqli->close();
        $checkone = 3;
    }
    else{
        echo "<h1><center>Please Enter Correct SID</center></h1>";
    }
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['feedb'])) {
// SQL query to select data from database
    $sid= $_POST['sid'];
    $sqlOne = "SELECT * FROM student where sid = $sid and pid = (SELECT pid from parent where phone = $phone)";  
    $resultOne = $mysqli->query($sqlOne);  
    $rowOne = mysqli_fetch_array($resultOne, MYSQLI_ASSOC);  
    $countOne = mysqli_num_rows($resultOne);
    if($countOne == 1){ 
        $sql = "SELECT * from feedbackft where sid = $sid";
        $result = $mysqli->query($sql);
        $mysqli->close();
        $checkone = 5;
    }
    else{
        echo "<h1><center>Please Enter Correct SID</center></h1>";
    }
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
        <h1>All Your Child's Assignments for the Selected Class</h1>
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
        <h1>Your Child's Profile(s)</h1>
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
        <h1>Enrolled Classes of Selected SID</h1>
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
        <h1>All Your Child's Assignments for the Selected Class</h1>
        <table>
            <tr>
                <th>FB. ID</th>
                <th>S. ID</th>
                <th>T. ID</th>
                <th>Remarks</th>
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
                <td><?php echo $rows['tid'];?></td>
                <td><?php echo $rows['remarks'];?></td>
                <td><?php echo $rows['date'];?></td>
                <td><?php echo $rows['reply'];?></td>
            <tr>
            <?php
                }
            ?>
        </table>
    </section>
    <form method="POST">
        <center>
            <h2>Send Reply</h2>
            <label for="fbid"><b>FB. ID: </b></label>
            <input type="number" name="fbid"><br><br>
            <label for="rep"><b>Reply: </b></label>
            <input type="text" name="rep" style="height: 20%;"><br><br>
            <input type="submit" name="send" value="Send">
        </center>
    </form>
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
                <th>Parent ID</th>
                <th>Name</th>
                <th>Phone No.</th>
                <th>Email Address</th>
                <th>Address</th>
            </tr>
            <?php
                while($rows=$result->fetch_assoc())
                {
            ?>
            <tr>
                <td><?php echo $rows['pid'];?></td>
                <td><?php echo $rows['name'];?></td>
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