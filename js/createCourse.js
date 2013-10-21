
function checkstuff()
{
    var x = document.forms["addCourse"]["ClassName"].value;
    if (x == null || x == "")
    {
        alert("Please enter a course name.");
        document.forms["addCourse"]["ClassName"].focus();
        return;
    }
    var x = document.forms["addCourse"]["ClassCRN"].value;
    if (x == null || x == "")
    {
        alert("Please enter the CRN.");
        document.forms["addCourse"]["ClassCRN"].focus();
        return;
    }
    var x = document.forms["addCourse"]["ClassStartDate"].value;
    if (x == null || x == "")
    {
        alert("Please enter a start date.");
        document.forms["addCourse"]["ClassStartDate"].focus();
        return;
	}
	var x = document.forms["addCourse"]["ClassEndDate"].value;
    if (x == null || x == "")
    {
        alert("Please enter the end date.");
        document.forms["addCourse"]["ClassEndDate"].focus();
        return;
	}
	
    document.forms["addCourse"].submit();
}