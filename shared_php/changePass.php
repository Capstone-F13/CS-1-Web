<?php
$title = "Change Password"; //enter title into the quotation marks
include("../shared_php/header.php");
?>
<div id="form_container">

<br><br> <h3> <u> Change Password </u> </h3> <br> 
    <form action="passChanged.php" method="post" >
        <ul>
            <li>
                <label class="description" for="currentPass">Current Password:</label>
                <input id="currentPass" name="currentPass" class="element text medium" type="password" maxlength="255" value=""/> 
            </li>
            <li>
                <label class="description" for="newPass">New Password: </label>
                <input id="newPass" name="newPass" class="element text medium" type="password" maxlength="255" value=""/>
            </li>
            <li>
                <label class="description" for="newPass2">Verify Password: </label>
                <input id="newPass2" name="newPass2" class="element text medium" type="password" maxlength="255" value=""/>
            </li>
              <div>
	<li class='buttons'>
	<input id='changepass' style='float:left;display:block;' class='button' type='submit' name='submit' value='Change' />
	
	</li>
    </div>
        </ul>
    </form>
</div>
<?php
include("../shared_php/footer.php");
?>