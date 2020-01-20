'use strict';

/**
* @package valkyrie.cms.js
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-framework
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since December 01 - 15, 2018 <@update>
* @version 1.0.1
* @summary cm-valkyrie-framework
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

$(window).on('beforeunload ajaxStart', function()
{
    $('body').prepend('<div data-ajax-loader><div class="loader"></div></div>');
});

$(window).on('ajaxStop', function()
{
    $('body').find('[data-ajax-loader]').remove();
});

$(document).ready(function()
{
    $('[data-low-uploader]').each(function()
    {
        uploader($(this), 'low');
    });

    $('[data-fast-uploader]').each(function()
    {
        uploader($(this), 'fast', $(this).data('fast-uploader'));
    });

    // $('[data-multiple-uploader]').each(function()
    // {
    //     uploader($(this), 'multiple', $(this).data('multiple-uploader'));
    // });

    $('[data-image-src]').each(function()
    {
        $(this).css('background-image', 'url("' + $(this).data('image-src') + '")');
    });
});

function checkFormValidations(target, response, callback)
{
    target.find('[name]').parents('.error').find('p.error').remove();
    target.find('[name]').parents('.error').removeClass('error');

    if (response.status == 'success')
        callback();
    else if (response.status == 'error')
    {
        if (Array.isArray(response.message))
        {
            $.each(response.message, function (key, value)
            {
                target.find('[name="' + value[0] + '"]').parent().addClass('error');
                target.find('[name="' + value[0] + '"]').parent().append('<p class="error">'+ value[1] +'</p>');
            });

            target.find('input[name="'+ response.message[0][0] +'"]').focus();
        }
        else
        {
            $('[data-modal="alert"] main > p').html(response.message);
            $('[data-modal="alert"]').addClass('view').animate({scrollTop: 0}, 0);
        }
    }
}

function uploader(target, type, action)
{
    target.find('a[data-select]').on('click', function()
    {
        target.find('input[data-select]').click();
    });

    target.find('input[data-select]').on('change', function()
    {
        if (type == 'low' || type == 'fast')
        {
            if ($(this)[0].files[0].type.match($(this).attr('accept')))
            {
                if (type == 'low')
                {
                    var reader = new FileReader();

                    reader.onload = function(e)
                    {
                        target.find('[data-preview] > img').attr('src', e.target.result);
                    }

                    reader.readAsDataURL($(this)[0].files[0]);
                }

                if (type == 'fast')
                {
                    var data = new FormData();

                    data.append('file', $(this)[0].files[0]);
                    data.append('action', action);

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
                }
            }
            else
            {
                $('[data-modal="alert"] main > p').html('Archivo no permitido');
                $('[data-modal="alert"]').addClass('view').animate({scrollTop: 0}, 0);
            }
        }

        // if (type == 'multiple')
        // {
        //     var data = new FormData();
        //     var files = document.getElementById('gallery');
        //
        //     for (var i = 0; i < files.files.length; i++)
        //     {
        //         data.append('files[]', files.files[i]);
        //     }
        //
        //     data.append('id', target.data('id'));
        //     data.append('action', action);
        //
        //     $.ajax({
        //         url: '',
        //         type: 'POST',
        //         data: data,
        //         contentType: false,
        //         processData: false,
        //         cache: false,
        //         dataType: 'json',
        //         success: function(response)
        //         {
        //             // if (response.status == 'success')
        //             // {
        //             //     target.find('[data-preview]').remove();
        //             //
        //             //     if (response.data.length > 0)
        //             //     {
        //             //         $.each(response.data, function(key, value)
        //             //         {
        //             //             target.prepend('<figure data-preview><img src="../uploads/' + value + '"><a data-delete="' + key + '"><i class="material-icons">delete</i></a></figure>');
        //             //         });
        //             //     }
        //             // }
        //             // else if (response.status == 'error')
        //             // {
        //             //     $('[data-modal="alert"] main > p').html(response.message);
        //             //     $('[data-modal="alert"]').addClass('view').animate({scrollTop: 0}, 0);
        //             // }
        //         }
        //     });
        // }
    });
}

function navScrollDown(target, $class, height)
{
    var nav = {
        initialize: function()
        {
            $(document).each(function()
            {
                nav.scroller()
            });

            $(document).on('scroll', function()
            {
                nav.scroller()
            });
        },
        scroller: function()
        {
            if ($(document).scrollTop() > height)
                $(target).addClass($class);
            else
                $(target).removeClass($class);
        }
    }

    nav.initialize();
}
