<?php
	$title = "Send Notification"; //enter title into the quotation marks
	include("../shared_php/header.php");
?>
<div id="form_container">
<br>
<br>

<h3> <u> Send Notification </u> </h3> <br>
	<form action="" method="post" >

		<ul >

			<li id="li_1" >
				<label class="description" for="subject">Subject:</label> <br>
				<div>
				  <input style="input.middle:focus {outline-width: 0;}" id="subject" name="subject" type="text" class="element text medium" maxlength="255">
				</div> 
			</li>
<br>

			<li id="li_2" >
				<label class="description" for="classname">Class Name: </label> <br>
				<div>
				<?php
	$result1 = $_SESSION['idmember'];

	$q="SELECT ClassName,idClass FROM Classes WHERE  ClassInstructorId='". $result1 ."' AND isFinished = 0 ";		
	$options = '';
	$result2=$mysqli->query($q);
	
	while($row = mysqli_fetch_array($result2)) {
    
    $options .="<option value=".$row['idClass'].">" . $row['ClassName'] . "</option>";

	
	
	
	}
	
	
$menu="<form id='classes' name='classes' method='post' action=''>
	
    <select name='classes' id='classes'>
    
      " . $options . "
    
    </select>

		</form>";
	echo $menu;
	

	?>
				
				
				</div>
				<br> 
				<label class="description" for="message">Message: </label> <br>
				<div>
					<textarea name="message" placeholder="Message" id="message" rows="10" cols="50"> </textarea>
				</div>
			</li>


			<li class="buttons">
				<!--<input type="hidden" name="form_id" value="568541" />-->

				<input id="saveForm" class="button" type="submit" name="submit" value="Send" />
			</li>
		</ul>
	</form>
	
	<?php
	


	
	
	if ($_REQUEST['submit']) {
		

		$subject = $_POST['subject'];
		$idClass = $_POST['classes'];
		$message = $_POST['message'];
		$q1 = "INSERT INTO Notification VALUES (null, '$subject', '$idClass', '$message')";

	
		$result = $mysqli->query($q1);
		if ($result) 
		{ 
			echo "Message Sent.\n";
		}
		else {echo "There was a problem sending your message! Try again!\n";}
		
		}
	
?>
	
</div>
<?php
	include("../shared_php/footer.php");
?>

