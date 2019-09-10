<?php

defined('_EXEC') or die;

$this->dependencies->add(['js', '{$path.js}Booking/index.min.js']);

$this->dependencies->add(['css', '{$path.plugins}fancybox/source/jquery.fancybox.css']);
$this->dependencies->add(['js', '{$path.plugins}fancybox/source/jquery.fancybox.pack.js']);
$this->dependencies->add(['js', '{$path.plugins}fancybox/source/jquery.fancybox.js']);

$this->dependencies->add(['other', '<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLCea8Q6BtcTHwY3YFCiB0EoHE5KnsMUE"></script>']);


?>

%{header}%
<section class="booking">
    <article>
        <header>
            <figure>
                <img src="{$cover}" alt="Cover">
            </figure>
        </header>
        <main>
            <div class="item">
                <h1>{$name}</h1>
                <h2>{$destination}</h2>
                <h2>{$price}</h2>
                <h2><span>{$discount}</span></h2>
                <p>{$description}</p>
                {$p_observations}
            </div>
            {$div_gallery}
            <div class="map">
                <div id="map"></div>
            </div>
            <div class="item">
                <form name="booking">
                    <h2>{$lang.book_now}</h2>
                    <fieldset class="fields-group">
                        <div class="row">
                            <div class="span4">
                                <div class="text">
                                    <h6>{$lang.date}</h6>
                                    <input type="date" name="date" min="<?php echo Functions::get_date('sum', Functions::get_date(), '1', 'days'); ?>" value="<?php echo Functions::get_date('sum', Functions::get_date(), '1', 'days'); ?>">
                                    <p class="caption">{$availability}</p>
                                </div>
                            </div>
                            <div class="span2">
                                <div class="text">
                                    <h6>{$lang.adults}</h6>
                                    <input type="number" name="adults" min="1" value="1">
                                </div>
                            </div>
                            <div class="span2">
                                <div class="text">
                                    <h6>{$lang.children}</h6>
                                    <input type="number" name="children" min="0" value="0">
                                </div>
                            </div>
                            <div class="span4">
                                <div class="text">
                                    <h6>{$lang.total}</h6>
                                    <input type="text" name="total" value="{$usd_total}" disabled>
                                    <p class="caption"><span>{$mxn_total}</span></p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="fields-group">
                        <div class="row">
                            <div class="span4">
                                <div class="text">
                                    <h6>{$lang.firstname}</h6>
                                    <input type="text" name="firstname">
                                </div>
                            </div>
                            <div class="span4">
                                <div class="text">
                                    <h6>{$lang.lastname}</h6>
                                    <input type="text" name="lastname">
                                </div>
                            </div>
                            <div class="span4">
                                <div class="text">
                                    <h6>{$lang.phone}</h6>
                                    <div class="ipt-slt-group">
                                        <input type="email" name="phone" placeholder="{$lang.number}">
                                        <select name="">
                                            <option value="" selected hidden>{$lang.lada}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="fields-group">
                        <div class="row">
                            <div class="span8">
                                <div class="text">
                                    <h6>{$lang.email}</h6>
                                    <input type="email" name="email">
                                </div>
                            </div>
                            <div class="span4">
                                <div class="text">
                                    <h6>{$lang.promotional_code}</h6>
                                    <input type="text" name="code" maxlength="6">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <a data-action="booking">{$lang.book_now}</a>
                </form>
            </div>
        </main>
        <footer>

        </footer>
    </article>
</section>
