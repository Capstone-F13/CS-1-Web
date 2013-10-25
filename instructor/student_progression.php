<?php
require_once("../shared_php/databaseConnect.php");
session_start();
$className = $_SESSION['ClassName'];
$classID = $_SESSION['ClassId'];
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="generator" content="RapidWeaver" />
        <title>Account</title>
        <link rel="stylesheet" type="text/css" media="screen" href="css/navbar.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/acourses.css" />
        <link rel="stylesheet" href="../css/layout.css">
        <script language="JavaScript1.1" src="../js/createAssignment.js" type="text/javascript"></script>
    </head>

<?php
if(isset($_REQUEST['submit']))
{	
	$studentId = $_REQUEST['StudentName'];
	$rosterQuery = "SELECT Member.LastName, Assignment.AssignmentName, Submission.Performance, Submission.Grade
					FROM Member
					INNER JOIN Roster ON Member.idMember = Roster.StudentId
					INNER JOIN Submission ON Roster.StudentId = Submission.SubmissionMemberId
					INNER JOIN Assignment ON Assignment.idAssignment = Submission.SubmissionAssignmentId
					WHERE Roster.ClassId = '$classID' AND Submission.SubmissionMemberId = '$studentId' 
					LIMIT 0 , 50";
	$rosterResult = $mysqli->query($rosterQuery);
?>
	<table cellpadding="5" >
	  <thead>
	    <tr>
	      <th>Student Name</th>
	      <th>Assignment Name</th>
	      <th>Progression</th>
	      <th>Grade</th>
	    </tr>
	  </thead>
	  <tbody>    
	      	<?php
	      		while ($row = $rosterResult->fetch_array())
	      		{
	      	?>     
	      			<tr>
	      			<td><?php echo $row['LastName']; ?></td>
	      			<td><?php echo $row['AssignmentName']; ?></td>
	      			<td><?php echo $row['Performance']; ?></td>
	      			<td><?php echo $row['Grade']; ?></td>	
	      			</tr>	
	      	<?php     			
	      		}      		
	      	?>
	  </tbody>
	</table>
<?php
}

else
{
	$studentQuery = "SELECT Lastname, idMember 
					 FROM Member
					 INNER JOIN Roster ON Member.idMember = Roster.StudentId
					 WHERE Roster.ClassId = '$classID'";
	$studentResult = $mysqli->query($studentQuery);

?>
<form action="student_progression.php" id="form" name="form" method="post">
	<table>
	  <thead>
	    <tr>
	      <th>Choose a student to see their progression</th>
	      <th>
	      	<select name="StudentName">
	          	<option value="" selected="selected" disabled="disabled">Select</option>
	        	<?php
	        	while($row = $studentResult->fetch_row())
				{
					$studentName = $row[0];
					$studentId = $row[1];
				?>
				    <option value="<?php echo $studentId ?>"> <?php echo $studentName ?> </option>;
				<?php
				}
	        	?>
              </select>
	      </th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>    
	  	  <td>
	  	  	<input type="submit" name="submit" value="Submit" />
	  	  </td>
	    </tr>
	  </tbody>
	</table>
</form>
<?php
}
?>
</html>
