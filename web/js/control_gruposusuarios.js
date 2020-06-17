
function existente(){
    var sel = document.getElementById('gruposusuarios-a01_id').value;
    if(sel){
        var id= document.getElementById('ide').value;

        parametro = {"id": id};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=grupos/checkrelaciones',
            data: parametro,
            dataType: "json",
            success: function (res) {
                //alert(res)
                if(res==1){
                    swal({
                        title: 'Relaciones Existentes',
                        text: '¿Deseas agregar un nuevo productor?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#942626',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'Cancelar',
                        allowOutsideClick: false,
                        allowEnterKey: false,
                    }).then(function (res) {
                        $( "#modalButton" ).trigger( "click" );
                    }, function (dismiss) {
                        $("#propietariounidad-c01_id").select2("val", "");
                    });
                }
            }
        });
    }


}
