<?php
require_once("../shared_php/databaseConnect.php");
session_start();

$query = "SELECT AssignmentName FROM Assignment WHERE AssignmentClass =". $_SESSION['AssignmentClass']."";
$result1 = $mysqli->query($query);


if (isset($_REQUEST['delete_assignment'])) {
	
	$assignmentName = $_REQUEST['txtAssignmentName'];
	
	$originalSQL = "SELECT * FROM Assignment WHERE AssignmentName='$assignmentName'";
	$result2 = $mysqli->query($originalSQL);
	$row = $result2->fetch_array();
	
	$idAssignment = $row['idAssignment'];
	
	
    $deleteSQL = "DELETE FROM Assignment
    WHERE idAssignment='$idAssignment'";  
    

    if(!$mysqli->query($deleteSQL))
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
        function ValidateForm()
		{
		    var x = document.forms["delete_assignment"]["txtAssignmentName"].value;
		    if (x == null || x == "")
		    {
		        alert("Please enter Assignment Name.");
		        document.forms["delete_assignment"]["txtAssignmentName"].focus();
		        return;
		    }
		    document.forms["delete_assignment"].submit();
		}
		</script>
    </head>
    <body>
        <form action="delete_assignment.php?delete_assignment=true&AssignmentClass=<?php echo $_SESSION['AssignmentClass']; ?>" id="delete_assignment" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>
                        <strong>Delete Assignment</strong></td>
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
                	<td colspan="2" align="center">
                        <button type="button" onclick="ValidateForm();">Submit</button></td>
                </tr>
           </table>
                
               	  