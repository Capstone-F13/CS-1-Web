<?php
require_once("../shared_php/databaseConnect.php");
session_start();
$_SESSION['AssignmentClass'] = $_REQUEST['AssignmentClass'];
error_reporting(E_ERROR);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="generator" content="RapidWeaver" />
<title>Account</title>
<link rel="stylesheet" type="text/css" media="screen" href="../css/navbar.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/main.css" />
<!-- <link rel="stylesheet" type="text/css" media="screen" href="../css/acourses.css" /> -->
<link rel="stylesheet" href="../css/layout.css">
<link rel="stylesheet" href="../css/jquery.dataTables.css">
<link rel="stylesheet" href="../css/jquery-ui.css">
<script type="text/javascript">

function ValidateForm()
{
	var x=document.forms["create_assignment"]["txtAssignmentName"].value;
	if (x==null || x=="")
	{
	 	alert("Please enter Assignment Name.");
		document.forms["create_assignment"]["txtAssignmentName"].focus();
	  	return;
	}
	var x=document.forms["create_assignment"]["txtDueDate"].value;
	if (x==null || x=="")
	{
	 	alert("Please enter Due Date.");
		document.forms["create_assignment"]["txtDueDate"].focus();
	  	return;
	}
	var x=document.forms["create_assignment"]["txtInstructions"].value;
	if (x==null || x=="")
	{
	 	alert("Please enter Instruction.");
		document.forms["create_assignment"]["txtInstructions"].focus();
	  	return;
	}
	var x=document.forms["create_assignment"]["cmbNoOfAttempts"].value;
	if (x==null || x=="0")
	{
	 	alert("Please select No of Attempts.");
	  	return;
	}
	var x=document.forms["create_assignment"]["cmbType"].value;
	if (x==null || x=="-1")
	{
	 	alert("Please select Assignment Type.");
	  	return;
	}	
	document.forms["create_assignment"].submit();
}

</script>
</head>
<body leftmargin="0px" topmargin="0px">
	
	<?php		
		$selectSQL="SELECT * FROM Classes where idClass = " . $_REQUEST['AssignmentClass'];
		$result=$mysqli->query($selectSQL);
		$row = mysqli_fetch_assoc($result);			
	?>
	<strong>Course : <?php echo $row['ClassName']; 	?> </strong> <br />
	<strong><a href="create_assignment.php?AssignmentClass=<?php echo $_REQUEST['AssignmentClass']; ?>">Create New Assignment</a></strong>
	<strong><a href="edit_assignment.php">Edit Assignment</a></strong>
	<strong><a href="delete_assignment.php">Delete Assignment</a></strong>
	<strong><a href="progression.php">Progression</a></strong>
        <table id="listOfStudent" cellpadding="5px" cellspacing="0px">
		<thead>
                    <tr>
	  		<th>Assignment ID</th>
			<th>Assignment Name</th>
			<th>Assignment Due Date</th>
			<th>Assignment Instructions</th>
			<th>Assignment Class</th>
			<th>Assignment Type</th>
			<th>Maximum Attempts</th>
			<th>Successes to Pass</th>
			<th>Download File</th>
                    </tr>
		</thead>
		<?php
		$selectSQL="SELECT * FROM Assignment where AssignmentClass=" . $_REQUEST['AssignmentClass'];
		$result=$mysqli->query($selectSQL);
                
                ?>
                <tbody>
                <?php /*/jQuery append to the tbody tag
                //Create table
                $doc = new DOMDocument();

                $table = $doc->createElement('table');
                $doc->appendChild($table);

                $table->setAttribute('id', 'ax');
                
                
                $tr = $doc->createElement('tr');
                $table->appendChild($tr);

                $col1 = $doc->createElement('td', $row['idAssignment']);
                $table->appendChild($col1);

                $col2 = $doc->createElement('td', $row['AssignmentName']);
                $table->appendChild($col2);
		*/

                if(mysqli_num_rows($result)>0)
		{
		
			while ($row = mysqli_fetch_assoc($result)) 
			{
                        ?>

                        <script>
                        $('#listofStudent').append('<tr><td>' + 'dogbait' + '</td></tr>');</script>

                        <?

                     /*   echo "<tbody>"
			."<tr>"
                        ."<td>{$row['idAssignment']}</td>"
			."<td>{$row['AssignmentName']}</td>"
                        ."<td>{$row['AssignmentDueDate']}</td>"
			."<td>{$row['AssignmentInstructions']}</td>"
			."<td>{$row['AssignmentClass']}</td>"
			."<td>{$row['AssignmentType']}</td>"
			."<td>{$row['AssignmentMaxAttempts']}</td>"
			."<td>{$row['SuccessesToPass']}</td>"
                        ."<td></td>"
                        ."</tr>"
                        ."</tbody>";*/
			}
		}
		else
			{
		?>
			<tr align="center">
			<td colspan="8" style="color:#FF0000; font-weight:bold;">No Assignment found</td>
			</tr>
		<?php
			}
		?>
	</table>
</body>

<script type="text/javascript">
if(document.getElementById("divAssignmentDetail")){
  document.getElementById("divAssignmentDetail").style.display="none";
  }
</script>

<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/DataTables.js"></script>

<script>
$(document).ready(function() {
      $('#listOfStudent').dataTable();
        alert("jQuery firing off!");
    } );
</script>

</html>
