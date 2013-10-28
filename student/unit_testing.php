<?php
$title = "Unit Test";       
include("../shared_php/header.php");

$idmember = $_SESSION['idmember'];


	$classQuery = "SELECT idClass, ClassName 
				   FROM Classes
				   INNER JOIN Roster ON Classes.idClass = Roster.ClassId
				   WHERE Roster.StudentId = $idmember";
	$classResults = $mysqli->query($classQuery);

	$assignmentQuery = "SELECT idAssignment, AssignmentName 
						FROM Assignment
						INNER JOIN Roster ON Assignment.AssignmentClass = Roster.ClassId
						WHERE Assignment.AssignmentClass = Roster.ClassId";
?>


<h1><center>Unit Testing</center></h1>


<?php
if(!isset($_REQUEST['class_submit']))
{
?>
<form action="unit_testing.php" name="form" id="form">
	<b>Choose a Class</b>
	<select>
		<option value="" selected="selected" disabled="disabled">Select</option>
		<?php
		while($row = $classResults->fetch_row())
		{
		?>
			<option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
		<?php
		}
		?>
	</select>
	<input type="submit" value="Submit" name="class_submit">
</form>
<?php
}
?>

<?php
else if()
?>
<form action="unit_testing.php" name="form" id="form">
	<b>Choose a Class</b>
	<select>
		<option value="" selected="selected" disabled="disabled">Select</option>
		<?php
		while($row = $classResults->fetch_row())
		{
		?>
			<option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
		<?php
		}
		?>
	</select>
	<input type="submit" value="Submit" name="class_submit">
</form>

