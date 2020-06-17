function cambio() {
    var temporal = $('.selectpicker').val();
    document.getElementById('aux_tipo').value=temporal;

    var contenido = temporal.toString().split(',');
    var tb = false;
    var br = false;
    var cv = false;

    for (var i = 0; i < contenido.length; i++) {
        if(contenido[i]=='B'){
            br=true;
        }else if (contenido[i]=='T'){
           tb=true;
        }else if (contenido[i]=='R'){
           cv=true;
        }
    }
    if(br){
        $( "#panel-info-br" ).fadeIn( "slow", function() {});
    }else{
        $( "#panel-info-br" ).fadeOut( "slow", function() {});
    }
    if(tb){
        $( "#panel-info-tb" ).fadeIn( "slow", function() {});
    }else{
        $( "#panel-info-tb" ).fadeOut( "slow", function() {});
    }
    if(cv){
        $( "#panel-info-cv" ).fadeIn( "slow", function() {});
    }else{
        $( "#panel-info-cv" ).fadeOut( "slow", function() {});
    }


}