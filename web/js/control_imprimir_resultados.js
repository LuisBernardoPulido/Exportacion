
$( document ).ready(function() {


    var send = document.getElementById('send').value;


    if(send==1){

        swal({
            title: '¡Guardado!',
            text: '¿Deseas imprimir tu hoja de resultados?!',
            type: 'success',
            //showCancelButton: true,
            confirmButtonColor: '#942626',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Imprimir',
            cancelButtonText: 'Cancelar'
        }).then(function () {
            document.getElementById("bton_imprimit").click();
        })
    }
});

function excel(id, pru, reporte){
    return location.href= "index.php?r=brucelosis/view&id="+id+"&pru="+pru+"&tipo="+reporte+"";
}
