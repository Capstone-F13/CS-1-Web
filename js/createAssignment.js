
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
    if (x == null || x == "0")
    {
        alert("Please select No of Attempts.");
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




