<?php
require_once("../shared_php/databaseConnect.php");
session_start();
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

		$selectSQL="SELECT * FROM Classes where idClass = " . $_REQUEST['ClassId'];
		$result=$mysqli->query($selectSQL);
		$row = mysqli_fetch_assoc($result);			
	?>
	<table>
		<tr>
			<td colspan="2"><strong>Course : <?php echo $row['ClassName']; 	?>	</strong></td>
		</tr>
		<tr>
			<td width="200"><strong><a href="addStudent.php" target="_parent">New Student</a></strong></td>
			<td width="200"><strong><a href="deleteStudent.php" target="_parent">Delete Student</a></strong></td>
		</tr>
		<tr>
		  <td colspan="2">
			<form method="post">
				<select name= "students">
					<option value=NULL>Select Student</option>

					<?php
						$selectSQL="SELECT * FROM Member where isInstructor = 0";
						$result=$mysqli->query($selectSQL);
						while ($row = mysqli_fetch_assoc($result)) 
						{
						
						
						echo "<option value='".$row['idMember'] . "'>". $row['FirstName']." ".$row['LastName'] . "</option>";

						}		
					?>
				</select>
				<input type="submit" name="Add_to_Course" id="Add_to_Course" value="Add to Course"> 
			</form>
			<?php
				if($_POST['Add_to_Course']){
					$student_id = $_POST['students'];
					$sql = "INSERT INTO Roster VALUES (NULL, " . $_REQUEST['ClassId'] . ", " . $student_id .")" ;
					$result = $mysqli->query($sql);
				}
			?>

		  </td>
	  </tr>
	</table>
	<table id="listOfStudent" width="100%" cellpadding="5px" cellspacing="0px">
		<thead>
	  <td>Member ID</td>
			<td>First Name</td>
			<td>Last Name</td>
			<td>Member Email</td>
			<td>Member Banner</td>
			<td></td>
		</thead>
		<?php
		$selectSQL="SELECT * FROM Roster inner join Member on StudentId = idMember WHERE ClassId=" . $_REQUEST['ClassId'];
		$result=$mysqli->query($selectSQL);

		if(mysqli_num_rows($result)>0)
		{
		
			while ($row = mysqli_fetch_assoc($result)) 
			{
		?>
			<tr>
			<td><?php echo $row['idMember']; ?></td>
			<td><?php echo $row['FirstName']; ?></td>
			<td><?php echo $row['LastName']; ?></td>
			<td><?php echo $row['MemberEmail']; ?></td>
			<td><?php echo $row['MemberBanner']; ?></td>
			<td>
			<?php echo "<a href=grades.php?ClassID='"; ?><?php echo $_REQUEST['ClassId']; echo "'&idMember='"; ?><?php echo $row['idMember']; echo "'>Grades</a>"
			?>
			</td>
			</tr>			
		<?php
			}
		}
		else
			{
		?>
			<tr align="center">
			<td colspan="6" style="color:#FF0000; font-weight:bold;">No Student found</td>
			</tr>
		<?php
			}
		?>
	</table>
</body>
</html>
