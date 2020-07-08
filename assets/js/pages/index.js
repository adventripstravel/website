"use strict";

$( document ).ready(function ()
{
    var owl = $('.slideshow-cover').owlCarousel({
        items:1,
        loop:false,
        margin:0,
        nav:false,
        mouseDrag:false,
        pullDrag:false,
        touchDrag:false,
        dots:false,
    });

    $('.next-slide').on('click', function ()
    {
        owl.trigger('next.owl.carousel');
    });

    $('.prev-slide').on('click', function ()
    {
        owl.trigger('prev.owl.carousel');
    });
});
