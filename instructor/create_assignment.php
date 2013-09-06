<?php
require_once("../shared_php/databaseConnect.php");

if (isset($_REQUEST['insert_assignment'])) {

    $insertSQL = "INSERT INTO Assignment (AssignmentName,AssignmentDueDate,
        AssignmentInstructions,AssignmentCode,AssignmentClass,
        AssignmentType,AssignmentMaxAttempts) VALUES ('"
            . $_REQUEST['txtAssignmentName'] . "','"
            . $_REQUEST['txtDueDate'] . "','"
            . $_REQUEST['txtInstructions'] . "','"
            . $_REQUEST['txtCode'] . "',"
            . $_REQUEST['AssignmentClass'] . ","
            . $_REQUEST['cmbType'] . ","
            . $_REQUEST['cmbNoOfAttempts'] . ")";

    mysql_query($insertSQL);

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
                        <button type="button" onclick="ValidateForm();">Submit</button>	</td>
                </tr>
            </table>
        </form>
    </body>
</html>

