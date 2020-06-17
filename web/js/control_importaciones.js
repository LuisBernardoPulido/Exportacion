function verificar(){
    swal({
        //title: '¿Desea renovar la licencia de este médico?',
        text: '¿Estás seguro de importar los aretes del archivo?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#942626',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Importar',
        cancelButtonText: 'Cancelar'
    }).then(function () {
        $( "#btn_subm_n" ).click();
        /*swal({
            title: 'Información!',
            text: 'I will close in 2 seconds.',
            timer: 2000
        }).then(
            function () {},
            // handling the promise rejection
            function (dismiss) {
                if (dismiss === 'timer') {
                    console.log('I was closed by the timer')
                }
            }
        )*/

    })
}
