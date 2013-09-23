<?php
$title = "Reopen Course"; //enter title into the quotation marks
include("../shared_php/header.php");
?>

<h3> Reopen Courses </h3>

<?php
// Check if Open button active, start this 
if($_POST['Open']){

$open_id = $_POST['radio_button'];
$sql = "UPDATE Classes SET isFinished = 0 WHERE idClass =" . $open_id ;
$result = $mysqli->query($sql);
unset($_POST['Open']);

// if successful redirect to delete_multiple.php
	if($result){
		echo "Course is reopened!!";
	}
}

//pull all courses where idMember = classinstructorid and isfinished = 0
$title = "SELECT * FROM Classes WHERE ClassInstructorId = " . $_SESSION['idmember'] . " AND isFinished = 1";
$query = $mysqli->query($title);
?>
<table width="400" border="0" cellspacing="1" cellpadding="0">
<tr>
<td><form name="form1" method="post" action="">
<table width="400" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td align="center" bgcolor="#FFFFFF">#</td>
<td align="center" bgcolor="#FFFFFF"><strong>Class Name</strong></td>
<td align="center" bgcolor="#FFFFFF"><strong>CRN</strong></td>
<td align="center" bgcolor="#FFFFFF"><strong>Start Date</strong></td>
<td align="center" bgcolor="#FFFFFF"><strong>End Date</strong></td>
</tr>

<?php
while($rows=mysqli_fetch_array($query)){
?>

<tr>
<td align="center" bgcolor="#FFFFFF"><input name="radio_button" type="radio" id="radio_button" value="<?php echo $rows['idClass']; ?>"></td>
<td bgcolor="#FFFFFF"><? echo $rows['ClassName']; ?></td>
<td bgcolor="#FFFFFF"><? echo $rows['ClassCRN']; ?></td>
<td bgcolor="#FFFFFF"><? echo $rows['ClassStartDate']; ?></td>
<td bgcolor="#FFFFFF"><? echo $rows['ClassEndDate']; ?></td>
</tr>

<?php
}
?>

<tr>
<td colspan="5" align="center" bgcolor="#FFFFFF"><input name="Open" type="submit" id="Opem" value="Open"></td>
</tr>



</table>
</form>
</td>
</tr>
</table>
<?php
include("../shared_php/footer.php");
?>