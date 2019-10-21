'use strict';

$(document).ready(function()
{
    /* Fancybox
    ------------------------------------------------------------------------------- */
    $('.fancybox-thumb').fancybox({
        openEffect: 'none',
        closeEffect: 'none',
        prevEffect: 'elastic',
        nextEffect: 'elastic',
        padding: 0,
        helpers:
        {
            thumbs:
            {
                width: 50,
                height: 50
            }
        }
   });

    $('.fancybox-media').fancybox({
        openEffect: 'fade',
        closeEffect: 'fade',
        prevEffect: 'elastic',
        nextEffect: 'elastic',
        padding: 0,
        helpers:
        {
            media: {}
        }
    });

    /* Get map
    ------------------------------------------------------------------------------- */
    $.ajax({
        type: 'POST',
        data: '&action=get_map',
        processData: false,
        cache: false,
        dataType: 'json',
        success: function(response)
        {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: parseFloat(response.data.location.lat),
                    lng: parseFloat(response.data.location.lng)
                },
                zoom: 14,
            });

            var location_marker = new google.maps.Marker({
                position: {
                    lat: parseFloat(response.data.location.lat),
                    lng: parseFloat(response.data.location.lng)
                },
                map: map,
            });

            var location_infowindow = new google.maps.InfoWindow({
                content: 'Aquí será tu tour',
            });

            location_infowindow.open(map, location_marker);

            location_marker.addListener('click', function() {
                location_infowindow.open(map, location_marker);
            });

            if (response.data.transportation.lat && response.data.transportation.lng)
            {
                var transportation_marker = new google.maps.Marker({
                    position: {
                        lat: parseFloat(response.data.transportation.lat),
                        lng: parseFloat(response.data.transportation.lng)
                    },
                    map: map,
                });

                var transportation_infowindow = new google.maps.InfoWindow({
                    content: 'Aqui te recogeremos',
                });

                transportation_infowindow.open(map, transportation_marker);

                transportation_marker.addListener('click', function() {
                    transportation_infowindow.open(map, transportation_marker);
                });
            }
        }
    });

    /* Get availability
    ------------------------------------------------------------------------------- */
    $('[name="date"]').on('change', function()
    {
        $.ajax({
            type: 'POST',
            data: 'date=' + $(this).val() + '&action=get_availability',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == 'success')
                    $('[name="date"]').parent().find('p.caption').html(response.data);
                else
                {
                    $('[data-modal="alert"] main > p').html(response.message);
                    $('[data-modal="alert"]').addClass('view');
                }
            }
        });
    });

    /* Get total
    ------------------------------------------------------------------------------- */
    $('[name="adults"]').on('change', function()
    {
        get_total();
    });

    $('[name="children"]').on('change', function()
    {
        get_total();
    });

    /* Booking
    ------------------------------------------------------------------------------- */
    $('[data-action="booking"]').on('click', function()
    {
        $('form[name="booking"]').submit();
    });

    $('form[name="booking"]').on('submit', function(e)
    {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: 'POST',
            data: form.serialize() + '&action=booking',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormValidations(form, response, function()
                {
                    window.location.href = response.path;
                });
            }
        });
    });
});

function get_total()
{
    $.ajax({
        type: 'POST',
        data: 'adults=' + $('[name="adults"]').val() + '&children=' + $('[name="children"]').val() + '&action=get_total',
        processData: false,
        cache: false,
        dataType: 'json',
        success: function(response)
        {
            if (response.status == 'success')
            {
                $('[name="total"]').val(response.data.usd);
                $('[name="total"]').parent().find('p.caption').find('span').html(response.data.mxn)
            }
            else
            {
                $('[data-modal="alert"] main > p').html(response.message);
                $('[data-modal="alert"]').addClass('view');
            }
        }
    });
}
