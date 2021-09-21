$(document).ready(function(){
    $("button").click(function(){

        var $name = $("#name").val();
        var $firstName = $("#firstName").val();
        var $age = $("#age").val();
        var $place = $("#place").val();

        $("#nameR").text($name);
        $("#firstNameR").text($firstName);
        $("#ageR").text($age);
        $("#placeR").text($place);

        $("#form").hide();

    });
});
