
load_form();

function load_form(){
    $.ajax({
        url: 'endpoint.php',
        dataType: 'html',
        data: {source: 'source.json', method: 'POST'},
        method: "POST",
        beforeSend: function(e){
            // $('#loading').show();
        },
        success: function(e){
            $('#form').html(e);
        },
        error: function(e){
            $('#loading').hide();
        }
    });
}