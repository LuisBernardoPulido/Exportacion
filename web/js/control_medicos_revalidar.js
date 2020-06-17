

function varlidarMedico(id) {
    swal({
        //title: '¿Desea renovar la licencia de este médico?',
        text: '¿Deseas renovar la licencia de este médico?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#942626',
        cancelButtonColor: '#d33',
        input: 'number',
        confirmButtonText: 'Renovar',
        cancelButtonText: 'Cancelar',
        inputValidator: function (value) {
            return new Promise(function (resolve, reject) {
                if (value) {
                    if(value.length!=4){
                        reject('¡Ingresa una vigencia válida!')
                    }else{
                        resolve()
                    }
                } else {
                    reject('¡Necesitas ingresar la vigencia!')
                }
            })
        }
    }).then(function (result) {
        parametro = {"id": id, "valor":result};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=medicos/renovar',
            data: parametro,
            success: function (respuesta) {
                swal({
                    //title: '¿Desea renovar la licencia de este médico?',
                    text: '¡Licencia Renovada!',
                    type: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#942626',
                    //cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                    //cancelButtonText: 'Cancelar'
                }).then(function () {
                    location.href= "index.php?r=medicos/index";
                });
                //swal('', '¡Licencia Renovada!', 'success');
            }
        });

    })

}
