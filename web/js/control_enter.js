/**
 * Created by Eduardo on 18/04/2017.
 */
$( document ).ready(function() {
    $('#por_arete').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#botonOkPorArete").click();
            e.preventDefault();
        }
    });
    $('#edad_por_arete_ind').on('keydown', function (e) {
        console.log("e")
        if (e.keyCode == 13) {
            $("#botonOkPorArete").click();
            e.preventDefault();
        }
    });
    $('#raza_por_arete_ind').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#botonOkPorArete").click();
            e.preventDefault();
        }
    });
    $('#raza2_por_arete_ind').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#botonOkPorArete").click();
            e.preventDefault();
        }
    });
    $('#sexo_por_arete_ind').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#botonOkPorArete").click();
            e.preventDefault();
        }
    });
    $('#inicio').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#botonOk").click();
            e.preventDefault();
        }
    });
    $('#fin').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#botonOk").click();
            e.preventDefault();
        }
    });
});