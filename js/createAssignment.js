
function ValidateForm()
{
    var x = document.forms["create_assignment"]["txtAssignmentName"].value;
    if (x == null || x == "")
    {
        alert("Please enter Assignment Name.");
        document.forms["create_assignment"]["txtAssignmentName"].focus();
        return;
    }
    var x = document.forms["create_assignment"]["txtDueDate"].value;
    if (x == null || x == "")
    {
        alert("Please enter Due Date.");
        document.forms["create_assignment"]["txtDueDate"].focus();
        return;
    }
    var x = document.forms["create_assignment"]["txtInstructions"].value;
    if (x == null || x == "")
    {
        alert("Please enter Instruction.");
        document.forms["create_assignment"]["txtInstructions"].focus();
        return;
    }
    var x = document.forms["create_assignment"]["cmbNoOfAttempts"].value;
    var y = document.forms["create_assignment"]["NoOfSuccessfulAttempts"].value;
    if (x == null || x == "0")
    {
        alert("Please select No of Attempts.");
        document.forms["create_assignment"]["cmbNoOfAttempts"].focus();
        return;
    }
    if (y == null || x == "0")
    {
        alert("Please select No of Successful Attempts.");
        document.forms["create_assignment"]["NoOfSuccessfulAttempts"].focus();
        return;
    }
    if (x < y)
    {
    	alert("Number of attempts can't be less than successful attempts.");
    	document.forms["create_assignment"]["NoOfSuccessfulAttempts"].focus();
    	return;
    }
    var x = document.forms["create_assignment"]["cmbType"].value;
    if (x == null || x == "-1")
    {
        alert("Please select Assignment Type.");
        return;
    }
    
    document.forms["create_assignment"].submit();
}




