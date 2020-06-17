/**
 * Created by Edd on 28/06/2017.
 */
$( document ).ready(function() {
    $('#arete').on('keydown', function (e) {
        if (e.keyCode == 13) {
            //alert("hola");
            $.pjax.reload({container: "#tablat", timeout: false});
            //$("#botonAgregar").click();
            //e.preventDefault();
        }
    });
});

$( document ).ready(function() {
    $('#bus_arete').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#botonAgregar").click();
            e.preventDefault();
        }
    });
    $('#bus_edad').on('keydown', function (e) {
        console.log("e")
        if (e.keyCode == 13) {
            $("#botonAgregar").click();
            e.preventDefault();
        }
    });
    $('#bus_raza1').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#botonAgregar").click();
            e.preventDefault();
        }
    });
    $('#bus_raza2').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#botonAgregar").click();
            e.preventDefault();
        }
    });
    $('#bus_sexo').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#botonAgregar").click();
            e.preventDefault();
        }
    });
});