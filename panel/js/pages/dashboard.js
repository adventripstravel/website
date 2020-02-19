$( document ).ready(function ()
{
    var DOM = $( this );

    var table_reservations = $('#table-reservations').DataTable({
        lengthChange: false,
        pageLength: 100,
        buttons: ['copy', 'excel', 'pdf'],
        order: [
            [4,'ASC']
        ],
        "columns": [
            { "orderable": false }, // NOMBRE
            { "orderable": false }, // FECHA RESERVADA
            { "orderable": false }, // FOLIO
            { "orderable": false, "searchable": false }, // BUTTONS ACTIONS
            { "orderable": true, "searchable": false }, // HIDDEN
        ]
    });

    table_reservations.buttons().container().appendTo('#table-reservations_wrapper .col-md-6:eq(0)');

    if ( typeof Skycons !== 'undefined' )
    {
        var icons = new Skycons( {"color": "#fff"}, {"resizeClear": true} ), list  = [
            "clear-day", "clear-night", "partly-cloudy-day",
            "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
            "fog"
        ], i;

        for ( i = list.length; i--; )
        icons.set(list[i], list[i]);
        icons.play();
    };
});
