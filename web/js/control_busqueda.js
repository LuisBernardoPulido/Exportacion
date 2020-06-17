/**
 * Created by Edd on 13/07/2017.
 */
$(document).ready(function(){
    $('#bus_arete').mask('0000000000');
});

$( "#bus_arete" ).keyup(function() {

    buscarArete();

});

function buscarArete(){
    var arete = document.getElementById('bus_arete').value
    var especie = document.getElementById('bus_esp').value

    if(arete.length>0 && especie>0){
        parametro = {"arete": arete, "especie": especie};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=site/getareteupp',
            data: parametro,
            dataType: "json",
            success: function (res) {
                if (res) {
                    document.getElementById('bus_edad').value = res[0];
                    document.getElementById('bus_raza1').value = res[1];
                    document.getElementById('bus_raza2').value = res[2];
                    var sexo = "";
                    if(res[3]==0)
                        sexo = "MACHO";
                    else if(res[3]==1)
                        sexo = "HEMBRA";
                    document.getElementById('bus_sexo').value = sexo;
                    document.getElementById('bus_upp').value = res[4];
                }
            }
        });

    }else{
        document.getElementById('bus_edad').value = "";
        document.getElementById('bus_raza1').value = "";
        document.getElementById('bus_raza2').value = "";
        document.getElementById('bus_sexo').value = "";
        document.getElementById('bus_upp').value = "";
    }
}