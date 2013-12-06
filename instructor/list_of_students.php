<?php
require_once("../shared_php/databaseConnect.php");
session_start();
error_reporting(E_ERROR | E_PARSE);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="generator" content="RapidWeaver" />
<title>Account</title>
<link rel="stylesheet" type="text/css" media="screen" href="../css/navbar.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/acourses.css" />
<link rel="stylesheet" href="../css/layout.css">
<link rel="stylesheet" href="../css/jquery.dataTables.css">
<link rel="stylesheet" href="../css/jquery-ui.css">

</head>
<body leftmargin="0px" topmargin="0px">

<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/DataTables.js"></script>

  <?php
    $classID = $_REQUEST['ClassId'];
    $selectSQL="SELECT * FROM Classes where idClass = " . $classID;
    $result=$mysqli->query($selectSQL);
    $row = mysqli_fetch_assoc($result);			
  ?>
  <!-- Before table -->
    <!-- query all students and assignments in course -->
  <script type = "text/javascript">
  var CourseStudents = [];
  </script>
  <?php
    $studentsSQL = "SELECT StudentId FROM roster WHERE ClassId = " . $classID;
    $studentsResult=$mysqli->query($studentsSQL);
      while ($studentsRow = mysqli_fetch_assoc($studentsResult)) 
      {
  ?>
        <script type = "text/javascript">
        CourseStudents.push("<?php echo $studentsRow['StudentId']; ?>");
        </script>
  <?php
      }
  ?>
    
  <script type = "text/javascript">
  var CourseAssignments = [];
  </script>
  <?php
    $assignmentsSQL= "SELECT idAssignment FROM assignment WHERE AssignmentClass = " . $classID;
    $assignmentsResult=$mysqli->query($assignmentsSQL);
      while ($assignmentRows = mysqli_fetch_assoc($assignmentsResult)) 
      {
  ?>
        <script type = "text/javascript">
        CourseAssignments.push("<?php echo $assignmentRows['idAssignment']; ?>");
        </script>
  <?php
      }
  ?>

    
  <script type = "text/javascript">
  //Now construct the student records with their info and grades as a 2D array
  var studentRows = [];
  </script>

  <?php
  //Need a loop to iterate through and find all grades for every student
  $idx = 0;
  $studentNumber = $_REQUEST['CourseStudents.length'];
  
  //One loop for iterating through students, one for iterating through grades
  while($idx < $studentNumber)
  {
    ?>
    <script type = "text/javascript">
    var studentRow = [];
    </script>

    <?php
    //$studentID = $_POST['CourseStudents[' . $idx . ']'];
    $studentID = "2";
    
    $studentGradesSQL = "SELECT Grade FROM submission WHERE SubmissionMemberId =" . $studentID;
    $studentGradesResult = $mysqli->query($studentGradesSQL);
        while($studentGradesRow = mysqli_fetch_assoc($studentGradesResult))
        {
    ?>
          <script type = "text/javascript">
          studentRow.push("<?php echo $studentGradesRow['Grade']; ?>");
          </script>
    <?php 
        }
    ?>
    <script type = "text/javascript">
    studentRows.push(studentRow);
    </script>
    <?php
    $idx++;
  }
  ?>
  <!-- End -->
    <table>
      <tr>
	<td colspan="2">
        <strong>Course : <?php echo $row['ClassName']; 	?></strong>
        </td>
      </tr>
      <tr>
	<td width="200">
        <strong><a href="addStudent.php" target="_parent">New Student</a></strong></td>
      <td width="200">
      <strong><a href="deleteStudent.php" target="_parent">Delete Student</a></strong></td>
      </tr>
      <tr>
        <td colspan="2">
	<form method="post">
	<select name= "students">
	<option value=NULL>Select Student</option>

	<?php
	  $selectSQL="SELECT * FROM Member where isInstructor = 0";
	  $result=$mysqli->query($selectSQL);
	  while ($row = mysqli_fetch_assoc($result)) 
          {
            echo "<option value='".$row['idMember'] . "'>". $row['FirstName']." ".$row['LastName'] . "</option>";

	  }		
	?>
	</select>
        <input type="submit" name="Add_to_Course" id="Add_to_Course" value="Add to Course"> 
	</form>
	<?php
	  if(isset($_POST['Add_to_Course'])){
	    $student_id = $_POST['students'];
	    $sql = "INSERT INTO Roster VALUES (NULL, " . $classID . ", " . $student_id .")" ;
            $result = $mysqli->query($sql);
	  }
	?>
        </td>
      </tr>
    </table>
    <table id="ah" cellpadding="5px" cellspacing="0px">
    </table>
</body>

<script type="text/javascript">
if(document.getElementById("divAssignmentDetail")){
  document.getElementById("divAssignmentDetail").style.display="none";
  }
</script>

<script>
$(document).ready( function () {
  $('#ah').dataTable( {
    "aaData" : studentRows,    
    "aoColumns" : [
            { "sTitle": "Assignment Fame" }
    ]
  } );
} );
</script>

</html>
