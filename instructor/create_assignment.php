<?php
require_once("../shared_php/databaseConnect.php");

if (isset($_REQUEST['insert_assignment'])) {

	$assignmentName = $_REQUEST['txtAssignmentName'];
	$dueDate = $_REQUEST['txtDueDate'];
	$instructions =  $_REQUEST['txtInstructions'];
	$code = $_REQUEST['txtCode'];
	$assignmentClass = $_REQUEST['AssignmentClass'];
	$type =  $_REQUEST['cmbType'];
	$noOfAttempts = $_REQUEST['cmbNoOfAttempts'];
	$successesToPass = $_REQUEST['NoOfSuccessfulAttempts'];
	
    $insertSQL = "INSERT INTO Assignment (AssignmentName,AssignmentDueDate,
        AssignmentInstructions,AssignmentCode,AssignmentClass,
        AssignmentType,AssignmentMaxAttempts, SuccessesToPass) 
                 VALUES ('$assignmentName', '$dueDate', '$instructions', '$code', 
                         '$assignmentClass', '$type', '$noOfAttempts', '$successesToPass')";
       
    $mysqli->query($insertSQL);

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
        <script language="JavaScript1.1" src="../js/createAssignment.js" type="text/javascript"></script>
    </head>
    <body>
        <form action="create_assignment.php?insert_assignment=true&AssignmentClass=<?php echo $_REQUEST['AssignmentClass']; ?>" id="create_assignment" method="post" enctype="multipart/form-data">
            <table>

                <tr>
                    <td>
                        <strong>Assignment Name</strong></td>
                    <td>
                        <input type="text" name="txtAssignmentName" value="" />	</td>
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
                            <option value=NULL> Infinite</option>
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
                <tr>
                	<td><strong>Successes in a Row</strong></td>
                    <td><select name="NoOfSuccessfulAttempts">
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
                    <td><strong>Assignment Type</strong> </td>
                    <td><select name="cmbType">
                            <option value="-1" selected="selected"> Select</option>
                            <option value="0"> C++</option>
                            <option value="1"> Python</option>
                        </select></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="button" onclick="ValidateForm();">Submit</button>	</td>
                </tr>
            </table>
        </form>
    </body>
</html>

