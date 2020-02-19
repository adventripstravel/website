'use strict';

get_total();

$(document).ready(function()
{
    const DOM = $(this);

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
    $("input[name='paxes']").TouchSpin({
        min: 1,
        max: 30,
        stepinterval: 1
    });

    $('.fancybox-thumb').fancybox({
        openEffect  : 'elastic',
		closeEffect  : 'elastic',
        nextEffect : 'elastic',
        prevEffect : 'elastic',
		closeBtn : false,
        padding: 0
    });

    DOM.on('change', 'select[name="nationality"]', function ()
    {
        DOM.find('[data-discount-text]').hide();
        DOM.find('[data-discount-text="'+ $(this).val() +'"]').show();

        get_total();
    });

    $('[name="childs"],[name="adults"],[name="paxes"]').on('change', function()
    {
        get_total();
    });

    $('form[name="create_booking"]').on('submit', function(e)
    {
        e.preventDefault();

        const form = $(this);
        let post = new FormData(this);

        post.append('action', 'create_booking');

        $.ajax({
            type: 'POST',
            data: post,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'json',
            success: function ( response )
            {
                checkFormDataErrors(form, response, function()
                {
                    $('[data-modal="success"]').addClass('view');
                    // $('[data-modal="success"]').find('main > p').html(response.message);
                    //
                    setTimeout(function() { location.reload(); }, 3000);
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
    const form = $('form[name="create_booking"]');
    let post = new FormData();

    post.append('babies', $('[name="babies"]').val());
    post.append('childs', $('[name="childs"]').val());
    post.append('adults', $('[name="adults"]').val());
    post.append('paxes', $('[name="paxes"]').val());
    post.append('nationality', $('[name="nationality"]').val());
    post.append('action', 'get_total');

    $.ajax({
        type: 'POST',
        data: post,
        contentType: false,
        processData: false,
        cache: false,
        dataType: 'json',
        success: function ( response )
        {
            checkFormDataErrors(form, response, function()
            {
                $( document ).find('[name="total"]').val(response.total);
            });
        }
    });




    // var form = $('form[name="create_booking"]');
    //
    // $.ajax({
    //     type: 'POST',
    //     data: 'childs=' + $('[name="childs"]').val() + '&adults=' + $('[name="adults"]').val() + '&apply_national_discount=' + $('[name="apply_national_discount"]').val() + '&action=get_total',
    //     processData: false,
    //     cache: false,
    //     dataType: 'json',
    //     success: function(response)
    //     {
    //         checkFormDataErrors(form, response, function()
    //         {
    //             $('[name="total"]').val(response.data.total);
    //         });
    //     }
    // });
}
