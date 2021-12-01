function getCourseDetails(selectObject) 
{   
    var value = selectObject.value;  
    if (value !== "Please select a course")
    {
        var xmlhttp = new XMLHttpRequest();
        $.ajax({
            url: "../get_course_details.php",
            type: "GET",
            data: {"courseName": value },
            //dataType: "application/json; charset=utf-8",
            success: function (data) {
                var parsed = JSON.parse(data);
                //alert(parsed[0]["name"]);
                $("#cnameUpdate").val(parsed[0]["name"]);
                //$("#cnameUpdate").html("test");
                $("#cdescUpdate").html(parsed[0]["description"]);
                $("#curlUpdate").html(parsed[0]["url"]);
            }
        });
    }
    else
    {
        $("#cnameUpdate").val("");
        $("#cdescUpdate").html("");
        $("#curlUpdate").html("");
    }
}