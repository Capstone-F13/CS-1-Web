
function validate()
{
    var x = document.forms["addCourse"]["CourseName"].value;
    if (x == null || x == "")
    {
        alert("Please enter Assignment Name.");
        document.forms["addCourse"]["CourseName"].focus();
        return;
    }
    var x = document.forms["addCourse"]["CourseCRN"].value;
    if (x == null || x == "")
    {
        alert("Please enter Due Date.");
        document.forms["addCourse"]["CourseCRN"].focus();
        return;
    }
    var x = document.forms["addCourse"]["CourseStartDate"].value;
    if (x == null || x == "")
    {
        alert("Please enter Instruction.");
        document.forms["addCourse"]["CourseStartDate"].focus();
        return;
	}
	var x = document.forms["addCourse"]["CourseEndDate"].value;
    if (x == null || x == "")
    {
        alert("Please enter Instruction.");
        document.forms["addCourse"]["CourseEndDate"].focus();
        return;
	}
    document.forms["addCourse"].submit();
}
