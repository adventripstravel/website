"use strict";

$( document ).ready(function ()
{
    var owl = $('.gallery').owlCarousel({
        margin:10,
        rewind:true,
        autoWidth:true,
        items:4,
        dots:false
    });

    $(".fancybox").fancybox({
        padding: 0
    });

    $("input[name='babies']").TouchSpin({
        min: 0,
        max: 10,
        stepinterval: 1
    });

    $("input[name='childs']").TouchSpin({
        min: 0,
        max: 20,
        stepinterval: 1
    });

    $("input[name='adults']").TouchSpin({
        min: 1,
        max: 20,
        stepinterval: 1
    });

    $('input[type="tel"]').inputmask("(999) 999-9999");

    $('#booking [button-submit]').ajaxSubmit({
        typeSend: 'click',
        formSubmit: $('form[name="booking"]'),
        callback: function( response )
        {
        }
    });

    $('#reservation').on('click', function()
    {
        $('#reservation_phone').toggleClass('view');
        $('#reservation_messenger').toggleClass('view');
        $('#reservation_whatsapp').toggleClass('view');
        $('#reservation_mail').toggleClass('view');
    });
});
