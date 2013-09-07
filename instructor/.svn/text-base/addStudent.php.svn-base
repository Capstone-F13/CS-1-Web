<?php
	$title = "Add Student"; //enter title into the quotation marks
	include("../shared_php/header.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<div id="form_container">

	<form action="studentAdded.php" method="post" >


      <br><br> <h3> <u> Add a Student(s)</u> </h3> <br> 

		<ul >

			<li id="li_1" >
				<label class="description" for="firstName">First Name:</label>
				<div>
					<input id="firstName" name="firstName" class="element text medium" type="text" maxlength="255" value=""/> 
				</div> 
				<label class="description" for="lastName">Last Name:</label>
				<div>
					<input id="lastName" name="lastName" class="element text medium" type="text" maxlength="255" value=""/> 
				</div> 
			</li>

			<li id="li_2" >
				<label class="description" for="banner">Banner ID: </label>
				<div>
					<input id="banner" name="banner" class="element text medium" type="number" max="999999999" min="100000000" value=""/> 
				</div> 
			</li>
			<script>
				banner.oninput = function () {
					if(this.value.length > 9)
						this.value = this.value.slice(0,9);
				}
			</script>
			<li id="li_3" >
				<label class="description" for="email">Email: </label>
				<div>
					<input id="email" name="email" class="element text medium" type="email" value=""/> 
				</div> 
			</li>


			<li class="buttons">
				<input type="hidden" name="form_id" value="568541" />
				<input id="saveForm" class="button_text" type="submit" name="submit" value="Submit" />
			</li>
		</ul>
	</form>	
</div>
<?php
	include("../shared_php/footer.php");
?>