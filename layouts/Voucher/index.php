<?php

defined('_EXEC') or die;

$this->dependencies->add(['js', '{$path.js}Voucher/index.min.js']);

?>

%{header}%
<main class="voucher">
    <section class="vo-st-1"></section>
    <section class="vo-st-2">
        <div class="container">
            <div data-image-src="{$tour_cover}">
                <h2>{$tour_name}</h2>
                <p>{$tour_summary}</p>
                <span><i class="fas fa-map-marker-alt"></i>{$tour_destination}</span>
                <a href="{$tour_url}">{$lang.view_tour_details}</a>
            </div>
            <div>
                <h1>{$lang.token}: {$token}</h1>
                <h6><strong>{$lang.childs}:</strong> {$childs} {$lang.paxes}</h6>
                <h6><strong>{$lang.adults}:</strong> {$adults} {$lang.paxes}</h6>
                <h6><strong>{$lang.booked_date}:</strong> {$booked_date}</h6>
                <p><strong>{$lang.observations}:</strong> {$observations}</p>
                <h6><strong>{$lang.firstname}:</strong> {$firstname}</h6>
                <h6><strong>{$lang.lastname}:</strong> {$lastname}</h6>
                <h6><strong>{$lang.email}:</strong> {$email}</h6>
                <h6><strong>{$lang.phone}:</strong> {$phone}</h6>
                <h6><strong>{$lang.total}:</strong> {$total}</h6>
                <h6><strong>{$lang.payment_status}:</strong> {$payment_status}</h6>
                <h6><strong>{$lang.payment_date}:</strong> {$payment_date}</h6>
                <h6><strong>{$lang.payment_method}:</strong> {$payment_method}</h6>
                <h6><strong>{$lang.payment_currency}:</strong> {$payment_currency}</h6>
                <h6><strong>{$lang.language}:</strong> {$language}</h6>
                <h6><strong>{$lang.status}:</strong> {$status}</h6>
                <h6><strong>{$lang.registration_date}:</strong> {$registration_date}</h6>
                {$btn_request_update_booking}
                {$btn_request_cancel_booking}
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
