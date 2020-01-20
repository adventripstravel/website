'use strict';

/**
* @package valkyrie.cms.js.users
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since December 01 - 15, 2018 <@update>
* @version 1.1.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

$(document).ready(function ()
{
    var id;

    /* Table
    ------------------------------------------------------------------------------- */
    $('table').DataTable({
        dom: 'Bfrtip',
        searching: true,
        buttons: [],
        info: true,
        paging: true,
        pageLength: 25,
        order: [],
        columnDefs: [
            {
                orderable: false,
                targets: '_all'
            },
            {
                className: 'text-left',
                targets: '_all'
            }
        ],
        language: {}
    });

    /* Keyup email to username
    ------------------------------------------------------------------------------- */
    $('[name="email"]').on('keyup', function()
    {
        $('[name="username"]').val($('[name="email"]').val());
    });

    /* Get
    ------------------------------------------------------------------------------- */
    $('[data-action="get"]').on('click', function()
    {
        id = $(this).data('id');

        var restore_password = $(this).data('restore-password');

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
                    $('[name="email"]').val(response.data.email);
                    $('[name="phone"]').val(response.data.phone);
                    $('[name="avatar"]').parents('.uploader').find('[data-preview] > img').attr('src', ((response.data.avatar != null) ? '../uploads/' + response.data.avatar : '../images/empty.png'));
                    $('[name="user_level"]').val(response.data.id_user_level);
                    $('[name="username"]').val(response.data.username);
                    $('[name="token"]').val(response.data.token);
                    $('[name="register_date"]').val(response.data.register_date);
                    $('[name="status"]').val(response.data.status);

                    if (restore_password != null)
                    {
                        $('[name="password"]').val('');

                        $('[name="name"]').attr('disabled', true);
                        $('[name="email"]').attr('disabled', true);
                        $('[name="phone"]').attr('disabled', true);
                        $('[name="avatar"]').attr('disabled', true);
                        $('[name="user_level"]').attr('disabled', true);
                        $('[name="username"]').attr('disabled', true);
                        $('[name="password"]').attr('disabled', false);
                        $('[name="token"]').attr('disabled', true);
                        $('[name="register_date"]').attr('disabled', true);
                        $('[name="status"]').attr('disabled', true);

                        $('[data-modal="datas"] header > h4').html('Restablecer contraseña');
                        $('[data-modal="datas"] main > form').attr('data-submit-action', 'restore');

                        $('[name="password"]').focus();
                    }
                    else
                    {
                        $('[name="password"]').val(response.data.password);

                        $('[name="name"]').attr('disabled', false);
                        $('[name="email"]').attr('disabled', false);
                        $('[name="phone"]').attr('disabled', false);
                        $('[name="avatar"]').attr('disabled', false);
                        $('[name="user_level"]').attr('disabled', false);
                        $('[name="username"]').attr('disabled', true);
                        $('[name="password"]').attr('disabled', true);
                        $('[name="token"]').attr('disabled', true);
                        $('[name="register_date"]').attr('disabled', true);
                        $('[name="status"]').attr('disabled', false);

                        $('[data-modal="datas"] header > h4').html('Detalles | Editar');
                        $('[data-modal="datas"] main > form').attr('data-submit-action', 'edit');

                        $('[name="name"]').focus();
                    }

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
        $('[name="name"]').attr('disabled', false);
        $('[name="email"]').attr('disabled', false);
        $('[name="phone"]').attr('disabled', false);
        $('[name="avatar"]').attr('disabled', false);
        $('[name="user_level"]').attr('disabled', false);
        $('[name="username"]').attr('disabled', true);
        $('[name="password"]').attr('disabled', false);
        $('[name="token"]').attr('disabled', true);
        $('[name="register_date"]').attr('disabled', true);
        $('[name="status"]').attr('disabled', false);

        $('[data-modal="datas"] header > h4').html('Nuevo');
        $('[data-modal="datas"] main > form').attr('data-submit-action', 'new');
        $('[data-modal="datas"] main > form')[0].reset();
        $('[data-preview] > img').attr('src', '../images/empty.png');
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

                    setTimeout(function() { location.reload() }, 1500);
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

                    setTimeout(function() { location.reload() }, 1500);
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
