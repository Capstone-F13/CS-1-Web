<?php
require_once("../shared_php/databaseConnect.php");
session_start();

$query = "SELECT AssignmentName FROM Assignment WHERE AssignmentClass =". $_SESSION['AssignmentClass']."";
$result1 = $mysqli->query($query);


if (isset($_REQUEST['edit_assignment'])) {
	
	
	 $r_assignmentName = $mysqli->real_escape_string($_REQUEST['txtAssignmentName']);
	 $r_txtDueDate = $mysqli->real_escape_string($_REQUEST['txtDueDate']);
	 $r_txtInstructions = $mysqli->real_escape_string($_REQUEST['txtInstructions']);
	 $r_txtCode = $mysqli->real_escape_string($_REQUEST['txtCode']);
	 $r_cmbType = $mysqli->real_escape_string($_REQUEST['cmbType']);
	 $r_cmbNoOfAttempts = $mysqli->real_escape_string($_REQUEST['cmbNoOfAttempts']);
	 $r_successfulAttempts = $_REQUEST['SuccessAttempts'];
	
	 $originalSQL = "SELECT * FROM Assignment WHERE AssignmentName='$r_assignmentName'";
	 $result2 = $mysqli->query($originalSQL);
	 $row = $result2->fetch_array();
	 
	 $d_assignmentid = $mysqli->real_escape_string($row['idAssignment']);


    $editSQL = "UPDATE Assignment   
    
    SET AssignmentName ='$r_assignmentName',  AssignmentDueDate ='$r_txtDueDate', AssignmentInstructions ='$r_txtInstructions', 
    AssignmentCode ='$r_txtCode',  AssignmentType='$r_cmbType', AssignmentMaxAttempts='$r_cmbNoOfAttempts', SuccessesToPass = '$r_successfulAttempts' 
    
    WHERE idAssignment = '$d_assignmentid'";

    if(!$mysqli->query($editSQL))
		printf("Errormessage: %s\n", $mysqli->error);
	
    header("Location:list_of_assignments.php?AssignmentClass=" . $_REQUEST['AssignmentClass']);
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
        <script>
function ValidateForm2()
{
    var x = document.forms["edit_assignment"]["txtAssignmentName"].value;
    if (x == null || x == "")
    {
        alert("Please enter Assignment Name.");
        document.forms["edit_assignment"]["txtAssignmentName"].focus();
        return;
    }
    var x = document.forms["edit_assignment"]["txtDueDate"].value;
    if (x == null || x == "")
    {
        alert("Please enter Due Date.");
        document.forms["edit_assignment"]["txtDueDate"].focus();
        return;
    }
    var x = document.forms["edit_assignment"]["txtInstructions"].value;
    if (x == null || x == "")
    {
        alert("Please enter Instruction.");
        document.forms["edit_assignment"]["txtInstructions"].focus();
        return;
    }
    var x = document.forms["edit_assignment"]["txtCode"].value;
    if (x == null || x == "")
    {
        alert("Please enter Code.");
        document.forms["edit_assignment"]["txtCode"].focus();
        return;
    }
    var x = document.forms["edit_assignment"]["cmbNoOfAttempts"].value;
    var y = document.forms["edit_assignment"]["SuccessAttempts"].value;
    if (x == null || x == "0")
    {
        alert("Please select No of Attempts.");
        document.forms["edit_assignment"]["cmbNoOfAttempts"].focus();
        return;
    }
    if (y == null || y == "0")
    {
        alert("Please select No of Successful Attempts.");
        document.forms["edit_assignment"]["SuccessAttempts"].focus();
        return;
    }
    if (x < y)
    {
        alert("Number of attempts can't be less than successful attempts.");
        document.forms["edit_assignment"]["NoOfSuccessfulAttempts"].focus();
        return;
    }
    var x = document.forms["edit_assignment"]["cmbType"].value;
    if (x == null || x == "-1")
    {
        alert("Please select Assignment Type.");
        return;
    }
    
    document.forms["edit_assignment"].submit();
}


</script>
    </head>
    <body>
        <form action="edit_assignment.php?edit_assignment=true&AssignmentClass=<?php echo $_SESSION['AssignmentClass']; ?>" id="edit_assignment" method="post" enctype="multipart/form-data">
            <table>

                <tr>
                    <td>
                        <strong>Assignment Name</strong></td>
                    <td>
                        <select name="txtAssignmentName">
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
                    <td><strong>Max Attempts</strong></td>
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
                	<td><strong>Successes in a Row</strong></td>
                    <td><select name="SuccessAttempts">
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
                        <button type="button" onclick="ValidateForm2();">Submit</button></td>
                </tr>
            </table>
        </form>
    </body>
</html>