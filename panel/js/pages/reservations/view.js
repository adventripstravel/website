$( document ).ready(function ()
{
    var DOM = $( this );

    // Enviar notificación
    DOM.on('click', '#accept_reservation', function ()
    {
        var self = $(this);
        var message = '';
        var xhr_status = '';

        swal({
            title: '¿Estás seguro?',
            text: "La reservación será aceptada",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#54cc96',
            cancelButtonColor: '#ff5560',
            confirmButtonText: 'Si',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            preConfirm: function ()
            {
                return new Promise(function (resolve)
                {
                    setTimeout(function ()
                    {
                        resolve();
                    }, 500);
                });
            }
        }).then(function ()
        {
            swal({
                type: 'success',
                title: 'Aceptada',
                html: 'Ahora la reservación fué aceptada.'
            });
        });
    });

    // Enviar notificación
    DOM.on('click', '#decline_reservation', function ()
    {
        var self = $(this);
        var message = '';
        var xhr_status = '';

        swal({
            title: '¿Estás seguro?',
            text: "La reservación se cancelará",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#54cc96',
            cancelButtonColor: '#ff5560',
            confirmButtonText: 'Si',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            allowOutsideClick: false,
            preConfirm: function ()
            {
                return new Promise(function (resolve)
                {
                    setTimeout(function ()
                    {
                        resolve();
                    }, 500);
                });
            }
        }).then(function ()
        {
            swal({
                type: 'success',
                title: 'Cancelada',
                html: 'La reservación fue cancelada.'
            });
        });
    });

});
