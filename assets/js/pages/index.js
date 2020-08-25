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

    $('.isla-mujeres-slide').on('click', function ()
    {
        owl.trigger('to.owl.carousel', [1]);
    });

    $('.isla-contoy-slide').on('click', function ()
    {
        owl.trigger('to.owl.carousel', [2]);
    });

    $('.tiburon-ballena-slide').on('click', function ()
    {
        owl.trigger('to.owl.carousel', [3]);
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
