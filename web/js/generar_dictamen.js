/**
 * Created by Eduardo on 20/02/2017.
 */
function crear(id) {

    var arete =document.getElementById('arete').value;
    var edad =document.getElementById('edad').value;
    var raza =document.getElementById('raza').value;
    var sexo =document.getElementById('sexo').value;
    var nsr =document.getElementById('nsr').value;
    parametro={"arete":arete, "raza":raza, "edad":edad, "sexo":sexo, "nsr":nsr, "id":id};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=dictamen-medico/nueva',
        data: parametro,
        success:function(respuesta){
            $.pjax.reload({container:"#tabla"});  //Reload GridView
        }
    });
}

