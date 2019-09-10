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

    /* Select discount
    ------------------------------------------------------------------------------- */
    $('[name="discount_type"]').on('change', function()
    {
        if ($('[name="discount_type"]').val() == '%' || $('[name="discount_type"]').val() == '$')
        {
            $('[name="discount_amount"]').attr('disabled', false);
            $('[name="discount_amount"]').focus();
        }
        else
        {
            $('[name="discount_amount"]').attr('disabled', true);
            $('[name="discount_amount"]').val('');
        }
    });

    /* Get
    ------------------------------------------------------------------------------- */
    $('[data-action="get"]').on('click', function()
    {
        id = $(this).data('id');
        var option = $(this).data('option');

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
                    if (option == 'datas')
                    {
                        $('[name="name_es"]').val(response.data.name.es);
                        $('[name="name_en"]').val(response.data.name.en);
                        $('[name="description_es"]').val(response.data.description.es);
                        $('[name="description_en"]').val(response.data.description.en);
                        $('[name="cost_adults"]').val(response.data.cost.adults);
                        $('[name="cost_children"]').val(response.data.cost.children);
                        $('[name="price_adults"]').val(response.data.price.adults);
                        $('[name="price_children"]').val(response.data.price.children);
                        $('[name="discount_amount"]').val(((response.data.discount != null) ? response.data.discount.amount : ''));
                        $('[name="discount_amount"]').attr('disabled', ((response.data.discount != null) ? false : true));
                        $('[name="discount_type"]').val(((response.data.discount != null) ? response.data.discount.type : ''));
                        $('[name="cover"]').parents('.uploader').find('[data-preview] > img').attr('src', '../uploads/' + response.data.cover);
                        $('[name="availability"]').val(response.data.availability);
                        $('[name="destination"]').val(response.data.id_destination);
                        $('[name="provider"]').val(response.data.id_provider);
                        $('[data-modal="datas"] header > h4').html('Detalles | Editar');
                        $('[data-modal="datas"] main > form').attr('data-submit-action', 'edit');
                        $('[data-modal="datas"]').addClass('view').animate({scrollTop: 0}, 0);
                    }
                    else if (option == 'gallery')
                    {
                        // $('[name="gallery"]').parents('.uploader').attr('data-id', id);
                        // $('[name="gallery"]').parents('.uploader').find('[data-preview]').remove();
                        //
                        // if (response.data.gallery != null)
                        // {
                        //     $.each(response.data.gallery, function(key, value)
                        //     {
                        //         $('[name="gallery"]').parents('.uploader').prepend('<figure data-preview><img src="../uploads/' + value + '"><a data-delete="' + key + '"><i class="material-icons">delete</i></a></figure>');
                        //     });
                        // }

                        $('[data-modal="gallery"] header > h4').html('Galería | ' + response.data.name.es);
                        $('[data-modal="gallery"]').addClass('view').animate({scrollTop: 0}, 0);
                    }
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
        $('[data-preview] > img').attr('src', '../images/empty.png');
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
        var data = new FormData(form[0]);

        data.append('id', id);
        data.append('action', form.data('submit-action'));

        $.ajax({
            url: '',
            type: 'POST',
            data: data,
            contentType: false,
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
