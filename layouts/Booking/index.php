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
        <span><i class="fas fa-globe-americas"></i>{$destination}</span>
        <div>
            <span><i class="fas fa-baby"></i>{$child_price}</span>
            <span><i class="fas fa-male"></i>{$adult_price}</span>
        </div>
    </section>
    <section class="bk-st-2">
        <div class="container">
            <div id="map" data-departure-title="{$lang.departure}" data-departure-lat="{$schedule_departure_place_lat}" data-departure-lng="{$schedule_departure_place_lng}" data-arrival-title="{$lang.arrival}" data-arrival-lat="{$schedule_arrival_place_lat}" data-arrival-lng="{$schedule_arrival_place_lng}" data-return-title="{$lang.return}" data-return-lat="{$schedule_return_place_lat}" data-return-lng="{$schedule_return_place_lng}"></div>
            <div>
                <div>
                    <h6>{$lang.departure}</h6>
                    <span><i class="fas fa-clock"></i>{$schedule_departure_hour}</span>
                    <span><i class="fas fa-map-marker-alt"></i>{$schedule_departure_place_name}</span>
                </div>
                <div>
                    <h6>{$lang.arrival}</h6>
                    <span><i class="fas fa-clock"></i>{$schedule_arrival_hour}</span>
                    <span><i class="fas fa-map-marker-alt"></i>{$schedule_arrival_place_name}</span>
                </div>
                <div>
                    <h6>{$lang.return}</h6>
                    <span><i class="fas fa-clock"></i>{$schedule_return_hour}</span>
                    <span><i class="fas fa-map-marker-alt"></i>{$schedule_return_place_name}</span>
                </div>
            </div>
        </div>
    </section>
    <section class="bk-st-3">
        <div class="container">
            {$description}
        </div>
    </section>
    {$fge_gallery}
    <section class="bk-st-5">
        <div class="container">
            <h6>¡{$lang.book_now}!</h6>
            <form name="new_booking">
                <fieldset class="fields-group">
                    <p class="warning"><span class="required-field">*</span>{$lang.required_fields}</p>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="row">
                        <div class="span3">
                            <div class="text">
                                <h6><span class="required-field">*</span>{$lang.childs}</h6>
                                <input type="number" name="childs" value="0" min="0">
                            </div>
                        </div>
                        <div class="span3">
                            <div class="text">
                                <h6><span class="required-field">*</span>{$lang.adults}</h6>
                                <input type="number" name="adults" value="1" min="1">
                            </div>
                        </div>
                        <div class="span3">
                            <div class="text">
                                <h6><span class="required-field">*</span>{$lang.date}</h6>
                                <input type="date" name="date" value="<?php echo Functions::get_future_date(Functions::get_current_date(), '1', 'days'); ?>" min="<?php echo Functions::get_future_date(Functions::get_current_date(), '1', 'days'); ?>">
                            </div>
                        </div>
                        <div class="span3">
                            <div class="text">
                                <h6>{$lang.total}</h6>
                                <input type="text" name="total" value="{$adult_price}" disabled>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="row">
                        <div class="span6">
                            <div class="text">
                                <h6><span class="required-field">*</span>{$lang.firstname}</h6>
                                <input type="text" name="firstname">
                            </div>
                        </div>
                        <div class="span6">
                            <div class="text">
                                <h6><span class="required-field">*</span>{$lang.lastname}</h6>
                                <input type="text" name="lastname">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="row">
                        <div class="span6">
                            <div class="text">
                                <h6><span class="required-field">*</span>{$lang.email}</h6>
                                <input type="email" name="email">
                            </div>
                        </div>
                        <div class="span2">
                            <div class="text">
                                <h6><span class="required-field">*</span>{$lang.lada}</h6>
                                <select name="phone_lada">
                                    <option value="" hidden>{$lang.select}</option>
                                    {$opt_ladas}
                                </select>
                            </div>
                        </div>
                        <div class="span4">
                            <div class="text">
                                <h6><span class="required-field">*</span>{$lang.phone}</h6>
                                <input type="number" name="phone_number">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6>{$lang.observations}</h6>
                        <textarea name="observations"></textarea>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="button">
                        <button type="submit">{$lang.book}</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
    <section class="bk-st-6">
        {$art_main_tours}
    </section>
</main>
