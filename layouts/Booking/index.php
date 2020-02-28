<?php

defined('_EXEC') or die;

// Bootstrap-touchspin
$this->dependencies->add(['css', '{$path.plugins}bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css']);
$this->dependencies->add(['js', '{$path.plugins}bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js']);

// FancyBox
$this->dependencies->add(['css', '{$path.plugins}fancy-box/source/jquery.fancybox.css']);
$this->dependencies->add(['js', '{$path.plugins}fancy-box/source/jquery.fancybox.pack.js']);
$this->dependencies->add(['js', '{$path.plugins}fancy-box/source/jquery.fancybox.js']);

$this->dependencies->add(['js', '{$path.js}Booking/index.js']);
$this->dependencies->add(['other', '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCea8Q6BtcTHwY3YFCiB0EoHE5KnsMUE&callback=map"></script>']);
?>

%{header}%
<main class="booking">
    <section class="bk-st-1" data-image-src="{$path.uploads}<?= $data['cover'] ?>">
        <h1><?= $data['name'] ?></h1>
        <p><?= $data['summary'] ?></p>
        <span><i class="fas fa-map-marker-alt"></i> <?= $data['destination'] ?></span>

        <?php if ( $data['available'] == true ): ?>
            <div>
                <?php if ( $data['price']['type'] == 'regular' ): ?>
                    <span><i class="fas fa-child"></i> <?= $data['final_price']['childs'] ?></span>
                    <span><i class="fas fa-user"></i> <?= $data['final_price']['adults'] ?></span>
                <?php endif; ?>

                <?php if ( $data['price']['type'] == 'height' ): ?>
                    <span class="height"><?= $data['final_price']['min'] ?> <i class="fas fa-minus"></i> <?= $data['price']['height'] ?> {$lang.height} <i class="fas fa-plus"></i> <?= $data['final_price']['max'] ?></span>
                <?php endif; ?>

                <?php if ( $data['price']['discounts']['foreign']['amount'] > 0 ): ?>
                    <?php if ( $data['price']['discounts']['foreign']['type'] == '%' ): ?>
                        <span class="discount"><?= $data['price']['discounts']['foreign']['amount'] ?>% {$lang.to_discount}</span>
                    <?php elseif ( $data['price']['discounts']['foreign']['type'] == '$' ): ?>
                        <span class="discount"><?= Functions::get_format_currency(Functions::get_currency_exchange($tour['price']['discounts']['foreign']['amount'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) ?> {$lang.to_discount}</span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php if ( $data['price']['discounts']['national']['amount'] > 0 ): ?>
                <?php if ( $data['price']['discounts']['national']['type'] == '%' ): ?>
                    <p>{$lang.if_you_are_mexican_get} <strong><?= $data['price']['discounts']['national']['amount'] ?>%</strong> {$lang.to_discount}</p>
                <?php elseif ( $data['price']['discounts']['national']['type'] == '%' ): ?>
                    <p>{$lang.if_you_are_mexican_get} <strong> <?= Functions::get_format_currency(Functions::get_currency_exchange($tour['price']['discounts']['national']['amount'], $tour['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) ?> </strong> {$lang.to_discount}</p>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </section>

    <?php if ( $data['available'] == true ): ?>
        <section class="bk-st-2">
            <div class="container">
                <div id="map"
                    data-departure-title="{$lang.departure}"
                    data-departure-lat="<?= $data['schedules']['departure']['place']['lat'] ?>"
                    data-departure-lng="<?= $data['schedules']['departure']['place']['lng'] ?>"
                    data-arrival-title="{$lang.arrival}"
                    data-arrival-lat="<?= $data['schedules']['arrival']['place']['lat'] ?>"
                    data-arrival-lng="<?= $data['schedules']['arrival']['place']['lng'] ?>"
                    data-return-title="{$lang.return}"
                    data-return-lat="<?= $data['schedules']['return']['place']['lat'] ?>"
                    data-return-lng="<?= $data['schedules']['return']['place']['lng'] ?>"></div>
                <div>
                    <div>
                        <h6>{$lang.departure}</h6>
                        <span><i class="fas fa-clock"></i><?= $data['schedules']['departure']['hour'] ?></span>
                        <span><i class="fas fa-map-marker-alt"></i><?= $data['schedules']['departure']['place']['name'] ?></span>
                    </div>
                    <div>
                        <h6>{$lang.arrival}</h6>
                        <span><i class="fas fa-clock"></i><?= $data['schedules']['arrival']['hour'] ?></span>
                        <span><i class="fas fa-map-marker-alt"></i><?= $data['schedules']['arrival']['place']['name'] ?></span>
                    </div>
                    <div>
                        <h6>{$lang.return}</h6>
                        <span><i class="fas fa-clock"></i><?= $data['schedules']['return']['hour'] ?></span>
                        <span><i class="fas fa-map-marker-alt"></i><?= $data['schedules']['return']['place']['name'] ?></span>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="bk-st-3">
        <div class="container">
            <?= $data['description'] ?>
        </div>
    </section>

    <?php if ( !empty($data['gallery']) ): ?>
        <section class="bk-st-4">
            <?php foreach ($data['gallery'] as $value): ?>
                <figure>
                    <img src="{$path.uploads}<?= $value ?>" alt="Gallery">
                    <a href="{$path.uploads}<?= $value ?>" class="fancybox-thumb" rel="fancybox-thumb"><i class="fas fa-search-plus"></i></a>
                </figure>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>

    <?php
        // unset($data['description']);
        // echo '<pre>';
        // print_R($data);
        // echo '</pre>';
    ?>

    <?php if ( $data['available'] == true ): ?>
        <section class="bk-st-5">
            <div class="container">
                <h6>¡{$lang.book_now}!</h6>

                <form name="create_booking">
                    <fieldset class="fields-group">
                        <div class="warning">
                            <p><span class="required-field">*</span>{$lang.required_fields}</p>
                        </div>
                    </fieldset>

                    <fieldset class="fields-group">
                        <div class="row">
                            <?php if ( $data['price']['type'] == 'regular' ): ?>
                                <div class="span2" style="margin-botom: 10px;">
                                    <div class="text">
                                        <h6>{$lang.babies}</h6>
                                        <input type="number" name="babies" value="0">
                                    </div>
                                    <div class="caption" style="float: none;">
                                        <p>0 - 2 {$lang.years}: {$lang.free}</p>
                                    </div>
                                </div>
                                <div class="span2" style="margin-bottom: 10px;">
                                    <div class="text">
                                        <h6>{$lang.childs}</h6>
                                        <input type="number" name="childs" value="0">
                                    </div>
                                    <div class="caption" style="float: none;">
                                        <p>3 - 7 {$lang.years}: </p>
                                    </div>
                                </div>
                                <div class="span2" style="margin-bottom: 10px;">
                                    <div class="text">
                                        <h6><span class="required-field">*</span>{$lang.adults}</h6>
                                        <input type="number" name="adults" value="2">
                                    </div>
                                    <div class="caption" style="float: none;">
                                        <p>8 - <span style="font-size: 23px;display: inline-block;vertical-align: middle;line-height: 0;font-weight: 100;">∞</span> {$lang.years}: </p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="span6" style="margin-bottom: 10px;">
                                    <div class="text">
                                        <h6><span class="required-field">*</span>{$lang.persons_number}</h6>
                                        <input type="number" name="paxes" value="2">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="<?= ( $data['price']['type'] == 'regular' ) ? 'span3' : 'span6' ?>" style="margin-bottom: 10px;">
                                <div class="text">
                                    <h6><span class="required-field">*</span>{$lang.date}</h6>
                                   <input type="date" name="date" value="<?= Functions::get_current_date() ?>" min="<?= Functions::get_current_date() ?>">
                                </div>
                            </div>

                            <?php if ( $data['price']['type'] == 'regular' ): ?>
                                <div class="span3" style="margin-bottom: 10px;">
                                    <div class="text">
                                        <h6>{$lang.total}</h6>
                                       <input type="text" name="total" value="" disabled>
                                    </div>
                                    <div class="caption" style="float: none;">
                                        <?= ( $data['price']['discounts']['national']['amount'] > 0 ) ? '<p data-discount-text="mexican">Se aplicó el '. $data['price']['discounts']['national']['amount'] . $data['price']['discounts']['national']['type'] .' {$lang.to_discount} para nacionales.</p>' : '' ?>
                                        <?= ( $data['price']['discounts']['foreign']['amount'] > 0 ) ? '<p style="display: none;" data-discount-text="other">Se aplicó el '. $data['price']['discounts']['foreign']['amount'] . $data['price']['discounts']['foreign']['type'] .' {$lang.to_discount}.</p>' : '' ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="fields-group">
                        <div class="row">
                            <div class="span6" style="margin-bottom: 10px;">
                                <div class="text">
                                    <h6><span class="required-field">*</span>{$lang.firstname}</h6>
                                    <input type="text" name="firstname">
                                </div>
                            </div>

                            <div class="span6" style="margin-bottom: 10px;">
                                <div class="text">
                                    <h6><span class="required-field">*</span>{$lang.lastname}</h6>
                                    <input type="text" name="lastname">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fields-group">
                        <div class="row">
                            <div class="span3" style="margin-bottom: 10px;">
                                <div class="text">
                                    <h6><span class="required-field">*</span>{$lang.email}</h6>
                                    <input type="email" name="email">
                                </div>
                            </div>

                            <div class="span3" style="margin-bottom: 10px;">
                                <div class="text">
                                    <h6><span class="required-field">*</span>Nacionalidad</h6>
                                    <select name="nationality">
                                        <option value="mexican" selected>Mexicano</option>
                                        <option value="other">Otra</option>
                                    </select>
                                </div>
                            </div>

                            <div class="span2" style="margin-bottom: 10px;">
                                <div class="text">
                                    <h6><span class="required-field">*</span>{$lang.lada}</h6>
                                    <select name="phone_lada">
                                        <option value="" hidden>{$lang.select}</option>
                                        <?php foreach ( $phone_ladas as $value ): ?>
                                            <option value="<?= $value['code'] ?>"><?= $value['name'][Session::get_value('vkye_lang')] ?> (+<?= $value['code'] ?>)</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="span4" style="margin-bottom: 10px;">
                                <div class="text">
                                    <h6><span class="required-field">*</span>{$lang.phone}</h6>
                                    <input type="text" name="phone_number">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fields-group">
                        <div class="row">
                            <div class="span12" style="margin-bottom: 10px;">
                                <div class="text">
                                    <h6>{$lang.observations}</h6>
                                    <textarea name="observations"></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="fields-group">
                        <div class="button">
                            <button type="submit">{$lang.book}</button>
                        </div>
                    </fieldset>
                </form>

                <div class="terms_condition">
                    <?= Session::get_value('settings')['terms_and_conditions'][Session::get_value('vkye_lang')] ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="bk-st-6">
        <?php foreach ( $data['main_tours'] as $value ): ?>
            <article>
                <main data-image-src="{$path.uploads}<?= $value['cover'] ?>">
                    <h2><?= $value['name'][Session::get_value('vkye_lang')] ?></h2>
                    <p><?= $value['summary'][Session::get_value('vkye_lang')] ?></p>
                    <span><i class="fas fa-map-marker-alt"></i><?= $value['destination'] ?></span>
                    <?php if ( $value['available'] == true ): ?>
                        <div>
                            <?php if ( $value['price']['type'] == 'regular' ): ?>
                                <span><i class="fas fa-child"></i></span>
                                <span><i class="fas fa-user"></i></span>
                            <?php elseif ($value['price']['type'] == 'height'): ?>
                                <span class="height"></span>
                            <?php endif; ?>

                            <?php if ( $value['price']['discounts']['foreign']['amount'] > 0 ): ?>
                                <?php if ( $value['price']['discounts']['foreign']['type'] == '%' ): ?>
                                    <span class="discount"><?= $value['price']['discounts']['foreign']['amount'] ?>% {$lang.to_discount}</span>
                                <?php elseif ( $value['price']['discounts']['foreign']['type'] == '$' ): ?>
                                    <span class="discount"><?= Functions::get_format_currency(Functions::get_currency_exchange($value['price']['discounts']['foreign']['amount'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) ?>{$lang.to_discount}</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <?php if ( $value['price']['discounts']['national']['amount'] > 0 ): ?>
                            <?php if ( $value['price']['discounts']['national']['type'] == '%' ): ?>
                                <p>{$lang.if_you_are_mexican_get} <strong><?= $value['price']['discounts']['national']['amount'] ?>%</strong> {$lang.to_discount}</p>
                            <?php elseif ( $value['price']['discounts']['national']['type'] == '$' ): ?>
                                <p>{$lang.if_you_are_mexican_get} <strong><?= Functions::get_format_currency(Functions::get_currency_exchange($value['price']['discounts']['national']['amount'], $value['price']['currency'], Session::get_value('currency')), Session::get_value('currency'), 0) ?></strong> {$lang.to_discount}</p>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>

                    <a href="/booking/<?= $value['url'] ?> "><?= ( $value['available'] == true ) ? '{$lang.book_now}' : '{$lang.not_available} | {$lang.view_more}' ?></a>
                </main>
            </article>
        <?php endforeach; ?>
    </section>


</main>
