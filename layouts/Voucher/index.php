<?php

defined('_EXEC') or die;

$this->dependencies->add(['js', '{$path.js}Voucher/index.min.js']);

?>

%{header}%
<main class="voucher">
    <section class="vo-st-1"></section>
    <section class="vo-st-2">
        <div class="container">
            <div>
                <h1>{$lang.token}: {$token}</h1>
                <h6>{$lang.childs}: {$childs} {$lang.paxes}</h6>
                <h6>{$lang.adults}: {$adults} {$lang.paxes}</h6>
                <h6>{$lang.booked_date}: {$booked_date}</h6>
                <p>{$lang.observations}: {$observations}</p>
                <h6>{$lang.firstname}: {$firstname}</h6>
                <h6>{$lang.lastname}: {$lastname}</h6>
                <h6>{$lang.email}: {$email}</h6>
                <h6>{$lang.phone}: {$phone}</h6>
                <h6>{$lang.total}: {$total}</h6>
                <h6>{$lang.payment_status}: {$payment_status}</h6>
                <h6>{$lang.payment_date}: {$payment_date}</h6>
                <h6>{$lang.payment_method}: {$payment_method}</h6>
                <h6>{$lang.payment_currency}: {$payment_currency}</h6>
                <h6>{$lang.language}: {$language}</h6>
                <h6>{$lang.status}: {$status}</h6>
                <h6>{$lang.registration_date}: {$registration_date}</h6>
                {$btn_request_update_booking}
                {$btn_request_cancel_booking}
            </div>
            <div data-image-src="{$tour_cover}">
                <h2>{$tour_name}</h2>
                <p>{$tour_summary}</p>
                <span><i class="fas fa-globe-americas"></i>{$tour_destination}</span>
                <a href="{$tour_url}">{$lang.view_tour_details}</a>
            </div>
        </div>
    </section>
</main>
<section class="modal" data-modal="request_update_booking">
    <div class="content">
        <header>
            <h4>{$lang.request_update_booking}</h4>
        </header>
        <main>
            <form name="request_update_booking">
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>{$lang.observations}</h6>
                        <textarea name="observations"></textarea>
                    </div>
                </fieldset>
            </form>
        </main>
        <footer>
            <div class="action-buttons">
                <button class="btn btn-flat" button-cancel>{$lang.cancel}</button>
                <button class="btn" button-success>{$lang.accept}</button>
            </div>
        </footer>
    </div>
</section>
<section class="modal" data-modal="request_cancel_booking">
    <div class="content">
        <header>
            <h4>{$lang.request_cancel_booking}</h4>
        </header>
        <main>
            <form name="request_cancel_booking">
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>{$lang.observations}</h6>
                        <textarea name="observations"></textarea>
                    </div>
                </fieldset>
            </form>
        </main>
        <footer>
            <div class="action-buttons">
                <button class="btn btn-flat" button-cancel>{$lang.cancel}</button>
                <button class="btn" button-success>{$lang.accept}</button>
            </div>
        </footer>
    </div>
</section>
