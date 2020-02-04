<?php

defined('_EXEC') or die;

$this->dependencies->add(['js', '{$path.js}Index/index.min.js']);

?>

%{header}%
<main class="home">
    <section class="hm-st-1" data-image-src="{$main_tour_cover}">
        <h1>{$main_tour_name}</h1>
        <p>{$main_tour_summary}</p>
        <span><i class="fas fa-map-marker-alt"></i>{$main_tour_destination}</span>
        {$div_main_tour_price}
        <a href="{$main_tour_url}">{$lang.book_now}</a>
    </section>
    <section class="hm-st-2">
        <div class="container">
            <form name="search_voucher">
                <fieldset class="fields-group">
                    <div class="text">
                        <input type="text" name="token" placeholder="{$lang.token}">
                        <button type="submit">{$lang.search}</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
    <section class="hm-st-3">
        {$art_tours}
    </section>
</main>
