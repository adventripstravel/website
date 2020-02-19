$( document ).ready(function ()
{
    var DOM = $(document);

    DOM.on('submit', '#login', function ( event )
    {
        event.preventDefault();

        var form = $(this);
        var post = new FormData(this);

        $.ajax({
            url: 'index.php?c=System&m=login',
            type: 'POST',
            data: post,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            beforeSend: function ()
            {
                form.find('[type="submit"]').attr('disabled', 'disabled');
                form.find('.form-group.has-danger .form-text.text-muted').remove();
                form.find('.form-group').removeClass('has-danger');

                $('#btn_login').attr('disabled', 'disabled').html('Espere...');
            },
            success: function ( response )
            {
                if ( response.status == 'error' )
                {
                    form.find('[type="submit"]').removeAttr('disabled');

                    $('#btn_login').removeAttr('disabled').html('Iniciar sesión');

                    $.each(response.labels, function(i, label)
                    {
                        var input = form.find('[name="' + label[0] + '"]');

                        input.parents('.form-group').addClass('has-danger');
                        input.after( "<small class='form-text text-muted'>" + label[1] + "</small>" );
                    });
                }
                else
                {
                    // window.location.href = response.redirect;
                    location.reload();
                }
            }
        });
    });
});
