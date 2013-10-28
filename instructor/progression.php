<?php
require_once("../shared_php/databaseConnect.php");
session_start();
$idMember = $_SESSION['idmember'];
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
	$assignmentId = $_REQUEST['AssignmentName'];
	$rosterQuery = "SELECT Member.LastName, Submission.Performance, Submission.Grade
					FROM Member
					INNER JOIN Roster ON Member.idMember = Roster.StudentId
					INNER JOIN Submission ON Roster.StudentId = Submission.SubmissionMemberId
					WHERE Roster.ClassId = '$classID' AND Submission.SubmissionAssignmentId = '$assignmentId' 
					LIMIT 0 , 30";
	$rosterResult = $mysqli->query($rosterQuery);
?>
	<table cellpadding="5" >
	  <thead>
	    <tr>
	      <th>Student Name</th>
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
	$assignmentQuery = "SELECT AssignmentName, idAssignment FROM Assignment WHERE AssignmentClass = '$classID'";
	$assignmentResult = $mysqli->query($assignmentQuery);

?>
<form action="progression.php" id="form" name="form" method="post">
	<table>
	  <thead>
	    <tr>
	      <th>Choose assignment to see student progression</th>
	      <th>
	      	<select name="AssignmentName">
	          	<option value="" selected="selected" disabled="disabled">Select</option>
	        	<?php
	        	while($row = $assignmentResult->fetch_row())
				{
					$assignmentName = $row[0];
					$assignmentId = $row[1];
				?>
				    <option value="<?php echo $assignmentId ?>"> <?php echo $assignmentName ?> </option>;
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