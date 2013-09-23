<?php
require_once("../shared_php/databaseConnect.php");
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

</head>
<body leftmargin="0px" topmargin="0px">
	<?php
		$selectSQL="SELECT * FROM member where idMember = " . $_REQUEST['idMember'];
		$result=$mysqli->query($selectSQL);
		$row = mysqli_fetch_assoc($result);			
	?>
	<table>
		<tr>
			<td colspan="2"><strong>Student : <?php echo $row['FirstName']; 	?>&nbsp;<?php echo $row['LastName']; 	?></strong></td>
		</tr>
	</table>
	<table id="listOfStudent" width="100%" cellpadding="5px" cellspacing="0px">
		<thead>
			  <td>Assignment Name </td>
			    <td>No of Attempts </td>
			<td>No of Successes </td>
			<td>Success in Row </td>
		</thead>
		<?php
		$selectSQL="SELECT * FROM grades inner join assignment on AssignmentID = idAssignment WHERE StudentId=" . $_REQUEST['idMember'];
		$result=$mysqli->query($selectSQL);

		if(mysqli_num_rows($result)>0)
		{
		
			while ($row = mysqli_fetch_assoc($result)) 
			{
		?>
			<tr>
			<td><?php echo $row['AssignmentName']; ?></td>
			<td><?php echo $row['NoOfAttempts']; ?></td>
			<td><?php echo $row['NoOfSuccesses']; ?></td>
			<td><?php echo $row['SuccessInRow']; ?></td>
			</tr>			
		<?php
			}
		}
		else
			{
		?>
			<tr align="center">
			<td colspan="4" style="color:#FF0000; font-weight:bold;">No Student found</td>
			</tr>
		<?php
			}
		?>
	</table>
</body>
</html>
