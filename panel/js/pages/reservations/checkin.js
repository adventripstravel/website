"use strict";

/** SignaturePad */
var wrapper_signature = document.getElementById("signature-pad");
var canvas_signature = wrapper_signature.querySelector("canvas");

window.onresize = resizeCanvas;
resizeCanvas();

function resizeCanvas()
{
    let ratio =  Math.max(window.devicePixelRatio || 1, 1);

    canvas_signature.width = canvas_signature.offsetWidth * ratio;
    canvas_signature.height = canvas_signature.offsetHeight * ratio;
    canvas_signature.getContext("2d").scale(ratio, ratio);
}

/** TODO */
$( document ).ready(function ()
{
    const DOM = $( this );

    $('select[name="folio"]').select2({
        placeholder: 'Busque una reservación.',
        allowClear: true
    });

    var signaturePad = new SignaturePad(canvas_signature, {
        backgroundColor: 'rgb(255, 255, 255)',
        onEnd: function () { $('input[name="signature"]').val('signed'); }
    });

    $("input[name='age']").TouchSpin({
        min: 1,
        stepinterval: 1,
        postfix: 'Años',
        buttondown_class: 'btn btn-secondary',
        buttonup_class: 'btn btn-secondary'
    });

    $('input[name="phone"]').inputmask("(999) 999-9999");

    DOM.on('change', "input[type='file']", function ()
    {
        if ( $(this).val() != '' )
            $(this).parents('[data-group-take-photo]').find('> div > span').attr('style', 'background-color: #4caf50;').html('<i class="dripicons-camera"></i> Cambiar foto');
        else
            $(this).parents('[data-group-take-photo]').find('> div > span').removeAttr('style').html('<i class="dripicons-camera"></i> Tomar foto');
    });

    $('form[name="checkin"]').parsley();

    DOM.on('submit', 'form[name="checkin"]', function ( event )
    {
        event.preventDefault();

        if ( $('form[name="checkin"]').parsley().isValid() )
        {
            let form = $(this);
            let post = new FormData(this);

            signaturePad.fromData(signaturePad.toData());
            post.append('blob', signaturePad.toDataURL("image/jpeg"));

            $.ajax({
                type: 'POST',
                data: post,
                contentType: false,
                processData: false,
                cache: false,
                dataType: 'json',
                beforeSend: function ()
                {
                    form.find('.form-group.has-danger .form-text.text-muted').remove();
                    form.find('.form-group').removeClass('has-danger');
                    $('#button_submit').attr('disabled', 'disabled').html('Espere...');
                },
                success: function ( response )
                {
                    if ( response.status == 'error' )
                    {
                        form.find('[type="submit"]').removeAttr('disabled');

                        $('#button_submit').removeAttr('disabled').html('Guardar');

                        $.each(response.labels, function(i, label)
                        {
                            var input = form.find('[name="' + label[0] + '"]');

                            input.parents('.form-group')
                                 .addClass('has-danger')
                                 .append( "<div class='offset-sm-3 col-sm-9'><small class='form-text text-muted'>" + label[1] + "</small></div>" );
                        });
                    }
                    else
                    {
                        swal({
                            type: 'success',
                            title: '¡Disfruta tu viaje!',
                            html: 'Gracias, se ha firmado correctamente la responsiva.',
                            showLoaderOnConfirm: true,
                            allowOutsideClick: false,
                            preConfirm: function ()
                            {
                                return new Promise(function (resolve)
                                {
                                    window.location.href = response.redirect;

                                    setTimeout(function ()
                                    {
                                        resolve();
                                    }, 5000);
                                });
                            }
                        });
                    }
                }
            });
        }
    });
});
