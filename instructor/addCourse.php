<?php
	$title = "Add Course"; //enter title into the quotation marks
	require_once("../shared_php/databaseConnect.php");
	include("../shared_php/header.php");
	
	if (isset($_REQUEST['insert_classes']))
	{
		$className = $_REQUEST['ClassName'];
		$classCRN = $_REQUEST['ClassCRN'];
		//$classInstructorID =  $_REQUEST['ClassInstructorID'];
		$classStartDate= $_REQUEST['ClassStartDate'];
		$classEndDate = $_REQUEST['ClassEndDate'];
		//$IsFinished =  $_REQUEST['isFinished'];
		
		$classes="INSERT INTO classes (idClass, ClassCRN, ClassName, ClassInstructorID, ClassStartDate, ClassEndDate, isFinished)
			VALUES('', '$classCRN','$className', '1', '$classStartDate', '$classEndDate', '')";
			
		//$lol = $mysqli->query($classes) ;
		//var_dump($lol);
		
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="generator" content="RapidWeaver" />
        <title>Add Course</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/navbar.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/acourses.css" />
        <link rel="stylesheet" href="../css/layout.css">
		<script language="JavaScript" src="../js/createCourse.js" type="text/javascript"></script>
	</head>
	<body>
		<form action ="addCourse.php?insert_classes=true" id="addCourse" method="post" enctype="multipart/form-data"
			<table align="center">
                <tr>
                	<br><br> <h3> <u> Add a Course: </u> </h3> <br> 
                    <td>
                        <strong>Course Name</strong></td>
                    <td>
                        <input type="text" name="ClassName" id="ClassName" value="" ></td>
                </tr>
                <br>
                </br>
                <tr>
                    <td><strong>CRN</strong></td>
                    <td><input type="text" name="ClassCRN" id="ClassCRN" ></td>
                </tr>
                <br>
                </br>
                <tr>
                    <td><strong>Class Start Date</strong></td>
                    <td><input id="datepicker1" name="ClassStartDate" id="ClassStartDate" class="element text medium" type="text" value=""></td>
                </tr>
                <br>
               	</br>
                <tr>
                	<td><strong>Class End Date</strong></td>
                	<td><input id="datepicker2" name="ClassEndDate" id-"ClassEndDate" class="element text medium" type="text" value""></td>
                </tr>
                <br>
               	</br>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="Submit" onClick="checkstuff()">	</td>
                </tr>
            </table>
        </form>
	</body>
</html>

<?php
	include("../shared_php/footer.php");
?>
