<?php
$title = "Closing Course"; //enter title into the quotation marks
include("../shared_php/header.php");
?>

    <br><br> <h3> <u> Close a Course(s): </u> </h3> <br> 

<?php
// Check if Close button active, start this 
if($_POST['Close']){
$close_id = $_POST['radio_button'];
$sql = "UPDATE Classes SET isFinished = 1 WHERE idClass =" . $close_id ;
$result = $mysqli->query($sql);

// if successful redirect to delete_multiple.php 
if($result){
echo "Course is closed!!";
}
}

//pull all courses where idMember = classinstructorid and isfinished = 0
$title = "SELECT * FROM Classes WHERE ClassInstructorId = " . $_SESSION['idmember'] . " AND isFinished = 0";
$result = $mysqli->query($title);
$count = $result->field_count;

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
while($rows=$result->fetch_array()){

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
<td colspan="5" align="center" bgcolor="#FFFFFF"><input name="Close" type="submit" id="Close" value="Close"></td>
</tr>

</table>
</form>
</td>
</tr>
</table>
<?php
include("../shared_php/footer.php");
?> 