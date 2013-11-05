function validate()
{
    var textarea = document.getElementById("txtarea").value;
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
        alert("Please choose an assignment.");
        return false;
    }

    if(textarea == "")
    {
        alert("Please enter code for the assignment.");
        return false;
    }

    document.getElementById("courses").submit();



}

function loadfile(input)
{
    var reader = new FileReader();
    reader.onload = function(e){
        document.getElementById('txtarea').value = e.target.result;
    }
    reader.readAsText(input.files[0]);
}