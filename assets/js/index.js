$(document).ready(function () {
    $("#showSlide").hide();
    $("#showMore-btn").click(function (e) {
        if($("#showMore-btn").text() == "Show more"){
            $("#showMore-btn").text("Show less");
            $("#showSlide").slideDown();
        }else{
            $("#showMore-btn").text("Show more");
            $("#showSlide").slideUp();
        }
    });
});