$( document ).ready(function ()
{
    var DOM = $( this );

    // Aceptar la reservación
    DOM.on('click', '#accept_reservation', function ()
    {
        var self = $(this);
        var folio = self.data('folio');
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
                    $.post('index.php?c=reservations&m=edit_status&p='+ folio, { value: 'available' }, function(data, status, jqXHR)
                    {
                        if ( data.status == 'OK' )
                        {
                            xhr_status = 'OK';
                            $('#accept_reservation,#decline_reservation').remove();
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
                    title: 'Aceptada',
                    html: 'La reservación cambio a estado "Disponible".'
                });
            }
        });
    });

    // Declinar reservación
    DOM.on('click', '#decline_reservation,#cancel_reservation', function ()
    {
        var self = $(this);
        var folio = self.data('folio');
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
                    $.post('index.php?c=reservations&m=edit_status&p='+ folio, { value: 'cancelled' }, function(data, status, jqXHR)
                    {
                        if ( data.status == 'OK' )
                        {
                            xhr_status = 'OK';
                            $('#accept_reservation,#decline_reservation,#cancel_reservation').remove();
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
                    title: 'Cancelada',
                    html: 'La reservación cambio a estado "Cancelado".'
                });
            }
        });
    });

});
