
$( "#scrolll" ).scroll(function() {
    var a = this.scrollTop;
    var d = this.scrollHeight - this.clientHeight;
    var c = a/d;
    var c_int = parseFloat(c);
    if(c_int>0.01){
        $( "#header_auxiliar_grid" ).fadeIn( "fast", function() {

        });

    }else{
        $( "#header_auxiliar_grid" ).fadeOut( "fast", function() {

        });

    }
});



