
$( document ).ready(function() {

    var num = document.getElementById('know_bruce').value;
    var num_tb = document.getElementById('know_tb').value;
    var send = document.getElementById('send').value;

    if(num>0 && send==1){
        swal({
            title: '¡Guardado!',
            text: '¿Deseas imprimir tu hoja de Serología?',
            type: 'success',
            //showCancelButton: true,
            confirmButtonColor: '#942626',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Imprimir',
            cancelButtonText: 'Cancelar'
        }).then(function (dismiss) {
            var id = document.getElementById('id_registro').value;
            parametro = {"id": id};
            document.getElementById("bton_imprimit").click();

        })
    }
    else if(num_tb>0 && send==1){
        swal({
            title: '¡Guardado!',
            text: '¿Deseas imprimir tu hoja de campo?',
            type: 'success',
            //showCancelButton: true,
            confirmButtonColor: '#942626',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Imprimir',
            cancelButtonText: 'Cancelar'
        }).then(function (dismiss) {
            var id = document.getElementById('id_registro').value;
            //parametro = {"id": id};
            //document.getElementById("bton_imprimit_tb").click();
            imprimirHojaCampo(id);
        })
    }
});

function excel(){
    var id = document.getElementById('id_registro').value;
    return location.href= "index.php?r=seleccion-previa/view&id="+id+"&tipo=1";
}

function enlaces(opcion, id){
    if(opcion==1)
        return location.href= "index.php?r=tuberculosis/dictamen&id="+id+"";
    else if(opcion==2)
        return location.href= "index.php?r=brucelosis/dictamen&id="+id+"";
    else if(opcion==2)
        return location.href= "index.php?r=vacunacion/dictamen&id="+id+"";
}

function imprimirHojaCampo(id){
    swal({
        title: 'Seleccionar Caratula.',
        input: 'select',
        inputOptions: {
            '1': 'Carátula anterior',
            '2': 'Carátula nueva'
        },
        inputPlaceholder: 'Elige una opción',
        showCancelButton: true,
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value !== '') {
                    resolve();
                } else {
                    reject('No se ha seleccionado un formato.');
                }
            });
        }
    }).then(function (result) {
        location.href= "index.php?r=seleccion-previa/hojacampo&id="+id+"&caratula="+result+"";
    }).catch(swal.noop);;
}

function imprimirExportacion(id){
    return location.href= "index.php?r=seleccion-previa/view&id="+id+"&tipo=2";
}
