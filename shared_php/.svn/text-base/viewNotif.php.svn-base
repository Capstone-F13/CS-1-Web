<?php session_start(); ?>
<?php
	$title = "View Notification"; //enter title into the quotation marks
	include("../shared_php/header.php");
?>

	
	<?php




		$result1 = $_SESSION['idmember'];
        $q=" SELECT idNotification,NotificationName,NotificationText,NotificationClassId FROM Notification,Roster WHERE NotificationClassId=ClassId AND StudentId='". $result1 ."' ";
        $result2=mysql_query($q);
  	
	echo ("<br><br> <h3> <u> Notifications </u> </h3> <br> ");
	while($data = mysql_fetch_row($result2)){

  	echo "<div id='form_container'>";
    	echo "	<form action='' method='post' >";

		echo "	<ul >";

		echo "	<li id='li_1' >";
		echo "<label class='description' for='subject'><h1> Subject: </h1> <br> </label> ";
		echo	"<div>";
		echo			"	<h4>	 $data[1] </h4>  ";
		echo		"</div>"; 
		echo	"</li>";

		echo "	<li id='li_3' >";
		echo "<label class='description' for='id'>  </label>";
		echo	"<div>";
		echo	"<textarea name='id' id='id' rows='10' cols='50' style='display:none;'> $data[0] </textarea>";
		echo		"</div>"; 
		echo	"</li>";
		
		echo	"<li id='li_2' >";
		echo		"<label class='description' for='classname'><h1> Class Name: </h1> <br>  </label>";
	

		echo		"<div>";
			$classnameQueryString = "SELECT ClassName FROM Classes WHERE idClass='". $data[3] ."' ";
    		$classnameQuery = mysql_query($classnameQueryString);
    		$classnameRow = mysql_fetch_array($classnameQuery);
 	    echo "<h4>" . $classnameRow['ClassName'] . "</h4><br />";
    	echo			"</div>";
		
	
	
		echo		"<label class='description' for='message'><h1> Message: </h1></label> <br>";
		echo	"	<div>";
		echo	"		<h4> $data[2] </h4> <br> <br> <hr> ";
		echo		"</div>";
    
    echo "<div>";
	echo "<li class='buttons'>";
	echo "<input id='deletenotif' style='float:left;display:block;' class='button' type='submit' name='submit' value='Delete' />";
	
	echo "</li>";
    echo "</div>";
	echo "</ul>";   
    echo "</form>";
    
    echo (" </a> <br> <hr>");

 
	

}
?>

<?php
echo ("<br> <br> <br>");
?>


<?php
	
   
 if ($_REQUEST['submit']) {
	
	$id = $_POST['id'];
			
		$q1 = "DELETE FROM Notification WHERE idNotification ='". $id ."' ";
	   		
		$result3 = mysql_query($q1);
		if ($result3) 
		{ 
			echo "Notificaton Deleted.\n";
		}
		else {echo "There was a problem deleteing your notification! Try again!\n";}
		
		}	

    ?>

<?php
	include("../shared_php/footer.php");
?>
