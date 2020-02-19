$( document ).ready(function ()
{
    var DOM = $( this );

    $.fn.editableform.buttons =
        '<button type="submit" class="btn btn-success editable-submit btn-sm waves-effect waves-light"><i class="mdi mdi-check"></i></button>' +
        '<button type="button" class="btn btn-danger editable-cancel btn-sm waves-effect waves-light"><i class="mdi mdi-close"></i></button>';

    $('#status_tour').editable({
        name: "status_tour",
        mode: 'inline',
        inputclass: 'form-control-sm',
        source: [
            {value: 'available', text: 'Disponible'},
            {value: 'closed', text: 'Cupo lleno'},
            {value: 'cancelled', text: 'Cancelado'}
        ],
        success: function(response, newValue)
        {
        },
        display: function (value, sourceData)
        {
            var colors = {"available": "#2196F3", "closed": "#4caf50", "cancelled": "#f44336"},
                elem = $.grep(sourceData, function (o) {
                    return o.value == value;
                });

            if (elem.length) {
                $(this).text(elem[0].text).css("color", colors[value]);
            } else {
                $(this).empty();
            }
        }
    });
});
