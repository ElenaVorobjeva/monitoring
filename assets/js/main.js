jQuery(function($) {
    getPage();
});


function getPage() {
    if($('#lang_switch input[name="options"]:checked').val()) {
        var lang = $('#lang_switch input[name="options"]:checked').val();
    }
    else {
        var lang = "ru";
    }

    $.ajax({
        type: "POST",
        url: "php/main.php",
        data: {
            lang: lang
        }
    }).done(function(result) {
            $("#main").empty();
            $("#main").html(result);
            $("#main").show();
            getMainTable(lang);
    });
}


function getMainTable(lang) {

    var t_1 = $("#input_t_1").val() + "00";
    var t_2 = $("#input_t_2").val() + "00";

    var arr = [];
    $('.model-list input:checkbox:checked').each(function() {
    	arr.push($(this).val());
    });
    var modelList = JSON.stringify(arr);

    $.ajax({
            type: "POST",
            url: "php/main_table.php",
            data: {
                t_1: t_1,
                t_2: t_2,
                modelList: modelList,
                lang: lang
            },
            beforeSend: function() {
                $("#details-wrapper").hide();
                $("#main-table").hide();
                $("#spinner").show();
            }
        }).done(function(result) {
            $("#main-table").empty();
            $("#main-table").html(result);
            if ($('#date-switch').is(':checked')){
                $("#main-table table td").addClass("date-on");
            }
            else {
                $("#main-table table td").removeClass("date-on");
            }
            $("#spinner").hide();
            $("#main-table").show();
        });
}

function infoFunc() {
    $("#info_block").show();
    $("html").css("overflow","hidden");
}

function infoCloseFunc() {
    $("#info_block").hide();
    $("html").css("overflow","visible");
}
