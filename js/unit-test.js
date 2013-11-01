function validate()
{
    var check = "";
    var len = document.courses.course.length;
    var i;
    
    alert("reaching the function");

    for(int i = 0; i < len; i++)
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

}