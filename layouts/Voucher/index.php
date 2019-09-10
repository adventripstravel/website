<?php

defined('_EXEC') or die;

$this->dependencies->add(['js', '{$path.js}Voucher/index.min.js']);

?>

%{header}%
<section class="voucher viewer">
    <article>
        <header>
            <figure>
                <img src="{$path.images}logotype_black.png" alt="Logotype">
            </figure>
        </header>
        <header class="no-padding">
            <figure>
                <img src="{$path.uploads}{$tour_cover}" alt="Cover">
            </figure>
        </header>
        <main>
            <h1>{$tour_name}</h1>
            <span>{$lang.token}: {$token}</span>
            <span>{$lang.fullname}: {$name} {$lang.email}: {$email} {$lang.cellphone}: {$cellphone}</span>
            <span>{$lang.your_booking_for}: {$date_booking}</span>
            <span>{$lang.paxes}: {$paxes_total} {$lang.paxes} ({$paxes_adults} {$lang.adults} {$paxes_children} {$lang.children})</span>
            <span>{$lang.total}: {$totals_amount} ({$lang.discount}: {$totals_discount} {$lang.taxes}: {$totals_taxes})</span>
            <span>{$lang.payment_method}: {$payment_method} {$lang.payment_currency}: {$payment_currency} {$lang.payment_datehour}: {$payment_datehour}</span>
            <span>{$lang.observations}: {$observations}</span>
            <span>{$lang.your_booked_at}: {$date_booked} {$lang.in} {$language} {$lang.applying_promotional_code} {$promotional_code}</span>
            <p>{$lang.by_booking_with_us} {$lang.thanks_for_booking_with_us}</p>
        </main>
        <footer>
            <!-- <a class="btn btn-colored">{$lang.resent_confirmation_email}</a> -->
            <a class="btn btn-colored" data-action="request" data-option="update">{$lang.update_booking}</a>
            <a class="btn btn-alert" data-action="request" data-option="cancel">{$lang.cancel_booking}</a>
        </footer>
    </article>
</section>
