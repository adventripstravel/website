<?php

defined('_EXEC') or die;

$this->dependencies->add(['js', '{$path.js}Index/index.min.js']);

?>

%{header}%
<main class="home">
    <section class="hm-st-1" data-image-src="{$main_tour_cover}">
        <h1>¡{$lang.book_now}!</h1>
        <h2>{$main_tour_name}</h2>
        <p>{$main_tour_summary}</p>
        <div>
            <span><i class="fas fa-baby"></i>{$main_tour_child_price}</span>
            <span><i class="fas fa-male"></i>{$main_tour_adult_price}</span>
        </div>
        <span><i class="fas fa-globe-americas"></i>{$main_tour_destination}</span>
        <a href="{$main_tour_url}">{$lang.book} | {$lang.view_more}</a>
    </section>
    <section class="hm-st-2">
        <div class="container">
            <form name="search_voucher">
                <h2>{$lang.my_booking}</h2>
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
