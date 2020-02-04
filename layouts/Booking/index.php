<?php

defined('_EXEC') or die;

$this->dependencies->add(['css', '{$path.plugins}fancy-box/source/jquery.fancybox.css']);
$this->dependencies->add(['js', '{$path.plugins}fancy-box/source/jquery.fancybox.pack.js']);
$this->dependencies->add(['js', '{$path.plugins}fancy-box/source/jquery.fancybox.js']);
$this->dependencies->add(['js', '{$path.js}Booking/index.min.js']);
$this->dependencies->add(['other', '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCea8Q6BtcTHwY3YFCiB0EoHE5KnsMUE&callback=map"></script>']);

?>

%{header}%
<main class="booking">
    <section class="bk-st-1" data-image-src="{$cover}">
        <h1>{$name}</h1>
        <p>{$summary}</p>
        <span><i class="fas fa-map-marker-alt"></i>{$destination}</span>
        {$div_price}
    </section>
    {$stn_schedules}
    <section class="bk-st-3">
        <div class="container">
            {$description}
        </div>
    </section>
    {$stn_gallery}
    {$stn_book_now}
    <section class="bk-st-6">
        {$art_main_tours}
    </section>
</main>
