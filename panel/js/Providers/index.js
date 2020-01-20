'use strict';

$(document).ready(function()
{
    var id;

    /* Table
    ------------------------------------------------------------------------------- */
    $(document).find('table').DataTable({
        dom: 'Bfrtip',
        buttons: [

        ],
        'columnDefs': [
            {
                'orderable': false,
                'targets': '_all'
            },
            {
                'className': 'text-left',
                'targets': '_all'
            }
        ],
        'order': [

        ],
        'searching': true,
        'info': true,
        'paging': true,
        'language': {

        }
    });

    /* Get
    ------------------------------------------------------------------------------- */
    $('[data-action="get"]').on('click', function()
    {
        id = $(this).data('id');

        $.ajax({
            url: '',
            type: 'POST',
            data: 'id=' + id + '&action=get',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                {
                    $('[name="name"]').val(response.data.name);
                    $('[data-modal="datas"] header > h4').html('Detalles | Editar');
                    $('[data-modal="datas"] main > form').attr('data-submit-action', 'edit');
                    $('[data-modal="datas"]').addClass('view').animate({scrollTop: 0}, 0);
                }
                else if (response.status == 'error')
                {
                    $('[data-modal="alert"] main > p').html(response.message);
                    $('[data-modal="alert"]').addClass('view').animate({scrollTop: 0}, 0);
                }
            }
        });
    });

    /* Modal to create or edit
    ------------------------------------------------------------------------------- */
    $('[data-modal="datas"]').modal().onSuccess(function()
    {
        $('form[name="datas"]').submit();
    });

    $('[data-modal="datas"]').modal().onCancel(function()
    {
        $('[data-modal="datas"] header > h4').html('Nuevo');
        $('[data-modal="datas"] main > form').attr('data-submit-action', 'new');
        $('[data-modal="datas"] main > form')[0].reset();
        $('[data-modal="datas"] main > form [name]').parents('.error').find('p.error').remove();
        $('[data-modal="datas"] main > form [name]').parents('.error').removeClass('error');
    });

    /* Create or Edit
    ------------------------------------------------------------------------------- */
    $('form[name="datas"]').on('submit', function(e)
    {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            url: '',
            type: 'POST',
            data: data.serialize() + '&id=' + id + '&action=' + action,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormValidations(form, response, function()
                {
                    $('[data-modal="datas"]').removeClass('view').animate({scrollTop: 0}, 0);
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view').animate({scrollTop: 0}, 0);

                    setTimeout(function() { location.reload() }, 1000);
                });
            }
        });
    });

    /* Delete
    ------------------------------------------------------------------------------- */
    $('[data-action="delete"]').on('click', function()
    {
        id = $(this).data('id');

        $('[data-modal="delete"]').addClass('view').animate({scrollTop: 0}, 0);
    });

    $('[data-modal="delete"]').modal().onSuccess(function()
    {
        $.ajax({
            url: '',
            type: 'POST',
            data: 'id=' + id + '&action=delete',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                $('[data-modal="delete"]').removeClass('view').animate({scrollTop: 0}, 0);

                if (response.status == 'success')
                {
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view').animate({scrollTop: 0}, 0);

                    setTimeout(function() { location.reload() }, 1000);
                }
                else if (response.status == 'error')
                {
                    $('[data-modal="alert"] main > p').html(response.message);
                    $('[data-modal="alert"]').addClass('view').animate({scrollTop: 0}, 0);
                }
            }
        });
    });
});
