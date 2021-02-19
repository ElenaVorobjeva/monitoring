function showDetails (date, model, lang) {

    $.ajax({
            type: "POST",
            url: "php/details.php",
            data: {
                date: date,
                model: model,
                lang: lang
            },
            beforeSend: function() {
                $("#details-wrapper").hide();
                $("#details-spinner").show();
            }
        }).done(function(result) {
            $("#details-wrapper").empty();
            $("#details-wrapper").html(result);
            $("#details-spinner").hide();
            $("#details-wrapper").show();
        });

}
