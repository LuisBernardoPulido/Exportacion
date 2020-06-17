$(function () {

    $('#modalButton').add('#modalButton2').click(function () {
        
        $('#modal').modal('show').find('#modalContent').load($(this).attr('value'));

    });

});


function modalOne(url) {

   // $('#modal').modal('show').find('#modalContent').load($url);
    window.location.href=url;
}

function modalTwo($url) {


    $('#modal2').modal('show').find('#modalContent2').load($url);

}
