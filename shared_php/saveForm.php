<?php
session_start();
if(isset($_POST['txtname']))
{
	$tab = "&nbsp; &nbsp; &nbsp;";
	$space= "&nbsp;&nbsp;";
	$z = $_POST['txtname'];
	$y = str_replace("", "" , str_replace(" ", $space , str_replace("\t", $tab, $z)));//"\n","<br>"
	$_SESSION['txtname'] = $y;
	$x = $_SESSION['txtname'];
	
	//echo $x;
}


?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/> <!--add to all html pages-->
		<title>Save Form</title>
		<link rel="stylesheet" href="../css/button.css">
	</head>
  
	<body>
		<pre>Please, fill the following form to save the code: </pre>
		<form action="saveForm_conf.php" method="post">
			<span>file name:</span>
			<input type="text" name="pName" required><br>
			<span>file extension: </span>
			<select name="fileExt" id="fileExt" style="padding-left:5px; margin-left:10px;" >
				<option value="">choose from the list.</option>			
				<option value=".cpp">.cpp</option>
				<option value=".h">.h</option>			
				<option value=".py">.py</option>
			</select>
			<br/>
			<textarea name="txt1" id="txt1" cols="15" rows="10" style="display:none;"><?php echo $z;?>
			</textarea>
			<br/>
			<br/>
			<input class="button" type="submit" name="submit"  id="submit" value="Save" style="margin-left:70px;">
        </form>
        <br />
	</body>
</html>


