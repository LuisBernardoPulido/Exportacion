function guardarParametro(id, p){
    var valor = document.getElementById('valor'+id);
    switch (valor.type){
        case 'text':
            if (valor.value == null || valor.value.length == 0 || /^\s*$/.test(valor.value)){
                swal ('ATENCIÓN','El campo '+p+' no puede estar vacío, o contener sólo espacios en blanco.', 'warning');
                return;
            }
            break;
        case 'number':
            if(valor.value == null || valor.value.length == 0 || isNaN(valor.value)) {
                swal ('ATENCIÓN','El campo '+p+' no puede estar vacío y debe ser numérico.', 'warning');
                return;
            }
            break;
        case 'email':
            if( valor.value == null || !validateEmail(valor.value) ) {
                swal ('ATENCIÓN','El campo '+p+' no puede estar vacío y debe ser un email válido.', 'warning');
                return;
            }
            break;
        case 'textarea':
            if (valor.value == null || valor.value.length == 0 || /^\s*$/.test(valor.value)){
                swal ('ATENCIÓN','El campo '+p+' no puede estar vacío, o contener sólo espacios en blanco.', 'warning');
                return;
            }
            break;
        default:
            if (valor.value == null || valor.value.length == 0 || /^\s*$/.test(valor.value)){
                swal ('ATENCIÓN','El campo '+p+' no puede estar vacío, o contener sólo espacios en blanco.', 'warning');
                return;
            }
    }

    swal({
            title:'¿Estas seguro?',
            text:'Guardar cambios de: '+p,
            type: 'warning',
            confirmButtonColor: '#942626',
            cancelButtonColor: '#d33',
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            closeOnConfirm: false,
            allowOutsideClick: false
        })
        .then(function(res){
            swal.disableButtons();
            parametros={"id":id,"valor":valor.value};
            $.ajax({
                type: 'GET',
                url: 'index.php?r=parametros/guardar',
                data: parametros,
                success:function(respuesta){
                    console.log(respuesta);
                    swal({
                        title:'Ok..',
                        text:p+' se ha guardado',
                        confirmButtonColor: '#942626',
                        type:'success'
                    }).then(function(res){
                        location.href='index.php?r=parametros/index';
                    });
                }
            });

        });
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}
