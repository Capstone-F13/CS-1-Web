<?php
	$title = "Student Added"; //enter title into the quotation marks
	include("../shared_php/header.php");
	
	$pass = md5($_POST['banner']); 
	$allStudents="SELECT * FROM Member WHERE MemberEmail='$_POST[email]'";
	$result = mysql_query($allStudents);		
	
	if(mysql_num_rows($result)!= 0)
	{
		echo 'Student Exists';
	}
	else
	{
		$students="INSERT INTO Member (FirstName, LastName, MemberEmail, MemberBanner, MemberPassword ,IsInstructor)
		VALUES('$_POST[firstName]','$_POST[lastName]','$_POST[email]','$_POST[banner]', '$pass', '0')";
		mysql_query($students);
		$result = mysql_query($allStudents);		
		if(mysql_num_rows($result)!=0)
			{
				echo "Student has been added!";
			} 
		
		else
		{
			echo("<br>Input data is failed");
		}
	}
	
	include("../shared_php/footer.php");
?>
