'use strict';

$(document).ready(function()
{
    $('.fancybox-thumb').fancybox({
        openEffect  : 'elastic',
		closeEffect  : 'elastic',
        nextEffect : 'elastic',
        prevEffect : 'elastic',
		closeBtn : false,
        padding: 0
    });

    $('[name="childs"]').on('change', function()
    {
        get_total();
    });

    $('[name="adults"]').on('change', function()
    {
        get_total();
    });

    $('form[name="new_booking"]').on('submit', function(e)
    {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: 'POST',
            data: form.serialize() + '&action=new_booking',
            processData: false,
            cache: false,
            dataType: 'json',
            success: function(response)
            {
                checkFormDataErrors(form, response, function()
                {
                    $('[data-modal="success"] main > p').html(response.message);
                    $('[data-modal="success"]').addClass('view');
                    setTimeout(function() { location.reload(); }, 4000);
                });
            }
        });
    });
});

function map()
{
    var map = $('#map');
    var departure_title = map.data('departure-title');
    var departure_lat = map.data('departure-lat');
    var departure_lng = map.data('departure-lng');
    var arrival_title = map.data('arrival-title');
    var arrival_lat = map.data('arrival-lat');
    var arrival_lng = map.data('arrival-lng');
    var return_title = map.data('return-title');
    var return_lat = map.data('return-lat');
    var return_lng = map.data('return-lng');

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 10,
        center: {
            lat: departure_lat,
            lng: departure_lng
        }
    });

    var departure_marker = new google.maps.Marker({
        position: {
            lat: departure_lat,
            lng: departure_lng
        },
        map: map
    });

    if (departure_lat == return_lat && departure_lng == return_lng)
    {
        var departure_marker_title = new google.maps.InfoWindow({
            content: departure_title + ' & ' + return_title
        });
    }
    else
    {
        var departure_marker_title = new google.maps.InfoWindow({
            content: departure_title
        });
    }

    departure_marker_title.open(map, departure_marker);

    departure_marker.addListener('click', function() {
        departure_marker_title.open(map, departure_marker);
    });

    var arrival_marker = new google.maps.Marker({
        position: {
            lat: arrival_lat,
            lng: arrival_lng
        },
        map: map
    });

    var arrival_marker_title = new google.maps.InfoWindow({
        content: arrival_title
    });

    arrival_marker_title.open(map, arrival_marker);

    arrival_marker.addListener('click', function() {
        arrival_marker_title.open(map, arrival_marker);
    });

    if (return_lat != departure_lat || return_lng != departure_lng)
    {
        var return_marker = new google.maps.Marker({
            position: {
                lat: return_lat,
                lng: return_lng
            },
            map: map
        });

        var return_marker_title = new google.maps.InfoWindow({
            content: return_title
        });

        return_marker_title.open(map, return_marker);

        return_marker.addListener('click', function() {
            return_marker_title.open(map, return_marker);
        });
    }
}

function get_total()
{
    var form = $('form[name="new_booking"]');

    $.ajax({
        type: 'POST',
        data: 'childs=' + $('[name="childs"]').val() + '&adults=' + $('[name="adults"]').val() + '&action=get_total',
        processData: false,
        cache: false,
        dataType: 'json',
        success: function(response)
        {
            checkFormDataErrors(form, response, function()
            {
                $('[name="total"]').val(response.data.total);
            });
        }
    });
}
