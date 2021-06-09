
load_form();


function load_form(){
    $.ajax({
        url: 'backend/load_form.php',
        dataType: 'html',
        data: {source: '../json/source.json', method: 'POST', url: 'backend/submit.php'},
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
