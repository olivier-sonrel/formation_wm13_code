$(document).ready(function(){
    $.ajax({
        url: "https://world.openfoodfacts.org/category/non-alcoholic-beverages.json",
        method: "GET",
        dataType : "json",
    })

    .done(function(response){
        let data = JSON.stringify(response, null,',');
        $("#answer").append(data);
    })

    .fail(function(error){
        alert("La requête s'est terminée en échec. Infos : " + JSON.stringify(error));
    })

    .always(function(){
        alert("Requête effectuée");
    });
});
