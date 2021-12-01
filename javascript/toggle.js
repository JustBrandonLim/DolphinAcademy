//javascript for toggling the 'click to update' button and the update form
$(document).ready(function(){
    var getbtn = document.getElementById("show_review");
    getbtn.addEventListener("click", hide);
    function hide(){
        console.log("inside hide");
        getbtn.style.display = "none";
        var getform = document.getElementById("form");
        getform.style.display = "block";
    }
});


