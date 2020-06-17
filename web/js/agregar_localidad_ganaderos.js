/**
 * Created by Eduardo on 26/04/2017.
 */
function agregarLocalidad() {
    var mpo = document.getElementById('ganaderos-c01_municipio').value;
    var edo = document.getElementById('ganaderos-c01_estado').value;
    if (mpo != '' && edo != ''){
        swal({
            title: 'Agregar Localidad',
            //text: 'v ' + edo + " " + mun,
            input: 'text',
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar',
            //closeOnConfirm: false,
            allowOutsideClick: false,
            showCancelButton: true,
        }).then(function (result) {
            var edo = document.getElementById('ganaderos-c01_estado').value;
            var mun = document.getElementById('ganaderos-c01_municipio').value;
            parametro = {"edo": edo, "mun": mun, "nom_loc": result};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=ganaderos/crearlocalidad',
                data: parametro,
                success: function (respuesta) {
                    if (respuesta > -1) {
                        cargarlocalidadesProductor();
                    }
                }
            });

        });
    }else{
        if(edo=='')
            alert("No se ha seleccionado un estado");
        else
            alert("No se ha seleccionado un municipio");

    }


}
/**
 * Created by Eduardo on 20/04/2017.
 */
