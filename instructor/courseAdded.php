<?php
	$title = "Course Add"; //enter title into the quotation marks
	include("../shared_php/header.php");
	
	$classes="INSERT INTO Classes (ClassCRN, ClassName, ClassInstructorId, ClassStartDate, ClassEndDate, isFinished)
	VALUES('$_POST[CRN]','$_POST[coursename]','$_SESSION[idmember]','$_POST[startDate]', '$_POST[endDate]', '0')";
	
	$result = mysql_query($classes);		
?>	

	<script>
		function validate(){
			if(document.getElementById('coursename').value==""){
				window.alert("You must enter a Course Name!");
				return false;
			}
			if(document.getElementById('CRN').value==""){
				window.alert("You must enter Course CRN!");
				return false;
			}
			if(document.getElementById('startDate').value==""){
				window.alert("You must enter the start date!");
				return false;
			}
			if(document.getElementById('endDate').value==""){
				window.alert("You must enter the end date!");
				return false;
			}
		}
	</script>

<?php
	if($result)
		{
			echo "Class has been added!";
		} 
	
	else
		{
			echo "Input data is failed!";
		}

	include("../shared_php/footer.php");
?>
