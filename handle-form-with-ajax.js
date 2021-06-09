
load_form();


function load_form(){
    $.ajax({
        url: 'load_form.php',
        dataType: 'html',
        data: {source: 'source.json', method: 'POST', url: 'submit.php'},
        method: "POST",
        beforeSend: function(e){
            $('#loading').show();
            $('#form').hide();
        },
        success: function(e){
            $('#loading').hide();
            $('#form').html(e).show();;
        },
        error: function(e){
            $('#loading').hide();
            $('#form').html(e).show();;
        }
    });
}
