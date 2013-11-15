function validate(codeEditor)
{
    var textarea = codeEditor.getValue();

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