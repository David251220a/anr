$(function(){
    
    $("#id_local").on('change', cambiomesa);

});

function cambiomesa(){

    var id_local = $(this).val();
    
    //AJAX
    $.get('/api/mesas/1/intendente', function(data){

        console.log(data);

    });

}