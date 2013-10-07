<?php
	$title = "Password Changed"; //enter title into the quotation marks
	include("../shared_php/header.php");

	if ($_POST["newPass"] == $_POST["newPass2"] && $_POST["newPass"] != NULL)
	{
		$pass = $_POST['currentPass'];
		$email = $_SESSION['email'];
		$newPass = $_POST['newPass'];
		$q1 = "UPDATE Member SET MemberPassword=md5('$newPass') WHERE MemberEmail='$email' AND MemberPassword=md5('$pass')";
		$mysqli->query($q1);	
	}
	$q2 = "SELECT * FROM Member WHERE MemberEmail = '$email' and MemberPassword=md5('$newPass')";
	$result = mysql_query($q2);
	if (mysqli_num_rows($result) > 0) 
	{ 
		echo "Password Changed.\n";
	}
	else {echo "Password Was Not Changed.\nCheck your spelling and try again.\n";}

	include("../shared_php/footer.php");
?>
