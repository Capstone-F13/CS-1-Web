<?php
	$title = "Add Course"; //enter title into the quotation marks
	include("../shared_php/header.php");
?>



<div id="form_container">

     <br><br> <h3> <u> Add a Course(s): </u> </h3> <br>

	<form action="courseAdded.php" method="post" onsubmit="return validate ()" >
		<ul>
			<li id="courseNameLi" >
				<label class="description" for="coursename">Name of the Course </label>
				<div>
					<input id="coursename" name="coursename" class="element text medium" type="text" maxlength="255" value=""/> 
				</div> 
			
			</li>	<li id="crnLi" >
				<label class="description" for="CRN">CRN </label>
				<div>
					<input id="CRN" name="CRN" class="element text medium" type="number" max="99999" min="10000" value=""/> 
				</div> 
			</li>
			<script>
				CRN.oninput = function () {
					if(this.value.length > 5)
						this.value = this.value.slice(0,5);
				}
			</script>
			
			<li id="startDateLi" >
				<label class="description" for="startDate">Date Course Starts </label>
				<div>
					<input id="datepicker1" name="startDate" class="element text medium" type="text" value=""/> 
				</div>

			</li>		
			
			<li id="endDateLi" >
				<label class="description" for="endDate">Date Course Ends </label>
				<div>
					<input id="datepicker2" name="endDate" class="element text medium" type="text" value=""/> 
				</div>

			</li>		
			
			   <div>
	<li class='buttons'>
	<input id='addcourse' style='float:left;display:block;' class='button' type='submit' name='submit' value='Add' />
	
	</li>
    </div>
		</ul>
	</form>	
</div>
<?php
	include("../shared_php/footer.php");
?>
