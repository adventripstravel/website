$( document ).ready(function ()
{
    var DOM = $( this );

    // Enviar notificación
    DOM.on('click', '#send_notification', function ()
    {
        var self = $(this);
        var message = '';
        var xhr_status = '';

        swal({
            title: '¿Estás seguro?',
            text: "La notificación se reenviará al cliente.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#54cc96',
            cancelButtonColor: '#ff5560',
            confirmButtonText: 'Si, reenviar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            preConfirm: function ()
            {
                return new Promise(function (resolve)
                {
                    $.post('index.php?c=reservations&m=send_notification', { folio: self.data('folio') }, function(data, status, jqXHR)
                    {
                        if ( data.status == 'OK' )
                        {
                            xhr_status = 'OK';
                        }
                        else
                        {
                            xhr_status = 'ERROR';
                            message = ( !data.message ) ? 'Error' : data.message;
                        }

                        setTimeout(function ()
                        {
                            resolve();
                        }, 500);
                    });
                });
            }
        }).then(function ()
        {
            if ( xhr_status == 'OK' )
            {
                swal({
                    type: 'success',
                    title: 'Reenviada',
                    html: 'Se reenvió la notificación al cliente.'
                });
            }
            else
            {
                swal({
                    type: 'error',
                    title: 'Error',
                    html: message
                });
            }

        });
    });

});
