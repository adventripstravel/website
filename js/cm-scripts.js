'use strict';

/**
* @package valkyrie.js
*
* @summary Stock de funciones opcionales para el programador.
*
* @author Gersón Aarón Gómez Macías <ggomez@codemonkey.com.mx>
* <@create> 01 de enero, 2019.
*
* @version 1.0.0.
*
* @copyright Code Monkey <contacto@codemonkey.com.mx>
*/

/**
* @summary Ejecuta el Data Loader al ejecutarse una acción Ajax.
*/
$(window).on('beforeunload ajaxStart', function()
{
    $('body').prepend('<div data-ajax-loader><div class="loader"></div></div>');
});

/**
* @summary Detiene el Data Loader al terminar de ejecutarse una acción Ajax.
*/
$(window).on('ajaxStop', function()
{
    $('body').find('[data-ajax-loader]').remove();
});

$(document).ready(function()
{
    /**
    * @summary Ejecuta la función uploader de tipo low.
    */
    $('[data-low-uploader]').each(function()
    {
        uploader($(this), 'low');
    });

    /**
    * @summary Ejecuta la función uploader de tipo fast.
    */
    $('[data-fast-uploader]').each(function()
    {
        uploader($(this), 'fast', $(this).data('fast-uploader'));
    });

    /**
    * @summary Agrega una imagen como background.
    */
    $('[data-image-src]').each(function()
    {
        $(this).css('background-image', 'url("' + $(this).data('image-src') + '")');
    });
});

/**
* @summary Agrega un clase de css a una etiqueta al detectar un scroll down.
*
* @param string target: Etiqueta a la que se agregará la clase.
* @param string style: Clase de css que se agregará.
* @param string height: Medida en la cual se agregará la clase a la etiqueta dentro del scroll down.
*
* @return object
*/
function navScrollDown(target, style, height, lt_target, lt_img_1, lt_img_2)
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
            {
                if (lt_target || lt_img_2)
                    $(lt_target).attr('src', lt_img_2);

                $(target).addClass(style);
            }
            else
            {
                if (lt_target || lt_img_1)
                    $(lt_target).attr('src', lt_img_1);

                $(target).removeClass(style);
            }
        }
    }

    nav.initialize();
}

/**
* @summary Revisa los errores que retornó el controlador y los aplica visualmente.
*
* @param string target: Formulario a revisar.
* @param string response: Respuesta del controlador.
* @param string callback: Acciones que se ejecutarán en caso que no haya errores.
*/
function checkFormDataErrors(target, response, callback)
{
    target.find('[name]').parents('.error').find('p.error').remove();
    target.find('[name]').parents('.error').removeClass('error');

    if (response.status == 'success')
        callback();
    else if (response.status == 'error')
    {
        if (Array.isArray(response.errors))
        {
            $.each(response.errors, function (key, value)
            {
                target.find('[name="' + value[0] + '"]').parent().addClass('error');
                target.find('[name="' + value[0] + '"]').parent().append('<p class="error">'+ value[1] +'</p>');
            });

            target.find('input[name="'+ response.errors[0][0] +'"]').focus();
        }
        else
        {
            $('[data-modal="alert"] main > p').html(response.errors);
            $('[data-modal="alert"]').addClass('view').animate({scrollTop: 0}, 0);
        }
    }
}

/**
* @summary Limpia el formulario y remueve los errores.
*
* @param string target: Formulario a limpiar.
*/
function clearFormData(target)
{
    target[0].reset();
    target.find('[data-preview] > img').attr('src', '../images/empty.png');
    target.find('[name]').parents('.error').find('p.error').remove();
    target.find('[name]').parents('.error').removeClass('error');
}

/**
* @summary Envia archivos al controlador para que se suban al almacenamiento.
*
* @param string target: Uploader.
* @param string type: (low, fast) Tipo de subida.
* @param boolean multiple: Define si se va a subir un solo archivo o muchos a la vez.
* @param string action: Tipo de acción que se enviará al controlador.
*/
function uploader(target, type, multiple, action)
{
    target.find('a[data-select]').on('click', function()
    {
        target.find('input[data-select]').click();
    });

    target.find('input[data-select]').on('change', function()
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
            else if (type == 'fast')
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

                            setTimeout(function() { location.reload() }, 1500);
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
            $('[data-modal="alert"] main > p').html('ERROR');
            $('[data-modal="alert"]').addClass('view').animate({scrollTop: 0}, 0);
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
