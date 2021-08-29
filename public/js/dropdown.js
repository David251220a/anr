$(function(){
    
    $("#id_local").on('change', cambiomesa);
    $("#id_local_consejal").on('change', cambiomesa_consejal);

});

function cambiomesa(){

    var id_local = $(this).val();
    var select = $("#id_mesa");
    
    if(! id_local){
        
        select.empty();
        return;
    }

    //AJAX
    $.get('mesas/'+id_local+'/intendente', function(data){

        var html_select = '<option  value="">Selecciona una mesa</option>';
        select.empty();

        for(var i=0; i < data.length; i++){

            select.append($("<option>", {
                value: data[i].Id_Mesa,
                text: data[i].Mesa
            }));
            // html_select = '<option  value="'+data[i].Id_Mesa+'">'+data[i].Mesa+'</option>';
            // $("#id_mesa").append("<option  value='"+data[i].Id_Mesa+"'>"+data[i].Mesa+"</option>");
            // $("#id_mesa").html(html_select);

        }


    });

}

function cambiomesa_consejal(){

    var id_local = $(this).val();
    var select = $("#id_mesa_consejal");
    
    if(! id_local){
        
        select.empty();
        return;
    }

    //AJAX
    $.get('mesas/'+id_local+'/consejal', function(data){

        var html_select = '<option  value="">Selecciona una mesa</option>';
        select.empty();

        for(var i=0; i < data.length; i++){

            select.append($("<option>", {
                value: data[i].Id_Mesa,
                text: data[i].Mesa
            }));

        }

    });

}