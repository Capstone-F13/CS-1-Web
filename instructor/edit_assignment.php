<?php
require_once("../shared_php/databaseConnect.php");
session_start();

$query = "SELECT AssignmentName FROM Assignment WHERE AssignmentClass =". $_SESSION['AssignmentClass']."";
$result1 = $mysqli->query($query);


if (isset($_REQUEST['edit_assignment'])) {
	
	
	 $r_assignmentName = $mysqli->real_escape_string($_REQUEST['assignmentName']);
	 $r_txtDueDate = $mysqli->real_escape_string($_REQUEST['txtDueDate']);
	 $r_txtInstructions = $mysqli->real_escape_string($_REQUEST['txtInstructions']);
	 $r_txtCode = $mysqli->real_escape_string($_REQUEST['txtCode']);
	 $r_cmbType = $mysqli->real_escape_string($_REQUEST['cmbType']);
	 $r_cmbNoOfAttempts = $mysqli->real_escape_string($_REQUEST['cmbNoOfAttempts']);
	
	$originalSQL = "SELECT * FROM Assignment WHERE AssignmentName='$r_assignmentName'";
	$result2 = $mysqli->query($originalSQL);
	$row = $result2->fetch_array();
	
	 $d_assignmentName = $mysqli->real_escape_string($row['AssignmentName']);
	 $d_txtDueDate = $mysqli->real_escape_string($row['AssignmentDueDate']);
	 $d_txtInstructions = $mysqli->real_escape_string($row['AssignmentInstructions']);
	 $d_txtCode = $mysqli->real_escape_string($row['AssignmentCode']);
	 $d_cmbType = $mysqli->real_escape_string($row['AssignmentType']);
	 $d_cmbNoOfAttempts = $mysqli->real_escape_string($row['AssignmentMaxAttempts']);

    $editSQL = "UPDATE Assignment   
    
    SET AssignmentName ='$r_assignmentName',  AssignmentDueDate ='$r_txtDueDate', AssignmentInstructions ='$r_txtInstructions', 
    AssignmentCode ='$r_txtCode',  AssignmentType='$r_cmbType', AssignmentMaxAttempts='$r_cmbNoOfAttempts' 
    
    WHERE AssignmentName ='$d_assignmentName',  AssignmentDueDate ='$d_txtDueDate', AssignmentInstructions ='$d_txtInstructions',
    AssignmentCode ='$d_txtCode',AssignmentType='$d_cmbType', AssignmentMaxAttempts='$d_cmbNoOfAttempts'";

    if(!$mysqli->query($editSQL))
		printf("Errormessage: %s\n", $mysqli->error);
	
    //header("Location:list_of_assignments.php?AssignmentClass=" . $_REQUEST['AssignmentClass']);
}
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
    <body>
        <form action="edit_assignment.php?edit_assignment=true&AssignmentClass=<?php echo $_SESSION['AssignmentClass']; ?>" id="edit_assignment" method="post" enctype="multipart/form-data">
            <table>

                <tr>
                    <td>
                        <strong>Assignment Name</strong></td>
                    <td>
                        <select name="assignmentName">
                        	<option value="" selected="selected" disabled="disabled">Select an Assignment</option>
                        	<?php
                        	while($row = $result1->fetch_row())
							{
								$assignment = $row[0];
							?>
							    <option value="<?php echo $assignment ?>"> <?php echo $assignment ?> </option>;
						<?php
							}
                        	?>
                        </select>
                </tr>
                <tr>
                    <td><strong>Due Date</strong></td>
                    <td><input id="txtDueDate" name="txtDueDate" class="element text medium" type="datetime-local" value=""/></td>
                </tr>
                <tr>
                    <td>
                        <strong>Instructions</strong></td>
                    <td>
                        <textarea name="txtInstructions" rows="5" cols="40"></textarea>	</td>
                </tr>
                <tr>
                    <td><strong>Code</strong></td>
                    <td><textarea name="txtCode" rows="5" cols="40"></textarea></td>
                </tr>
                <tr>
                    <td><strong>Attempts</strong></td>
                    <td><select name="cmbNoOfAttempts">
                            <option value="0" selected="selected"> Select</option>
                            <option value="1"> 1</option>
                            <option value="2"> 2</option>
                            <option value="3"> 3</option>
                            <option value="4"> 4</option>
                            <option value="5"> 5</option>
                            <option value="6"> 6</option>
                            <option value="7"> 7</option>
                            <option value="8"> 8</option>
                            <option value="9"> 9</option>
                            <option value="10"> 10</option>
                        </select></td>
                </tr>
                <tr>
                    <td><strong>Assignment Type</strong> </td>
                    <td><select name="cmbType">
                            <option value="-1" selected="selected"> Select</option>
                            <option value="0"> C++</option>
                            <option value="1"> Python</option>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" onclick="ValidateForm();" value="Submit"></td>
                </tr>
            </table>
        </form>
    </body>
</html>