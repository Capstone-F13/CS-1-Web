function validate()
{

    var check = "";
    var len = document.courses.course.length;
    var i = 0;

    for(i; i < len; i++)
    {
        if(document.courses.course[i].checked)
        {
            check = courses.course[i].checked;
            break;
        }
    }

    if(check == "")
    {
        alert("Please choose a class.");
        return false;
    }

    var textarea = document.getElementById("txtname").value;

    if(textarea == "" || textarea == null)
    {
        alert("Please enter code for the assignment.");
        return false;
    }

}
