<?php

defined('_EXEC') or die;

$this->dependencies->add(['js', '{$path.js}Contact/index.min.js']);

?>

%{header}%
<main class="contact">
    <section class="ct-st-1"></section>
    <section class="ct-st-2">
        <div class="container">
            <div>
                <h1>Adventrips</h1>
                <div>
                    <span><i class="fas fa-envelope"></i>{$_vkye_email}</span>
                    <span><i class="fas fa-phone"></i>{$_vkye_phone}</span>
                </div>
                <div>
                    <a href="https://api.whatsapp.com/send?phone={$_vkye_phone}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <!-- <a href="{$_vkye_tripadvisor}" target="_blank"><i class="fab fa-tripadvisor"></i></a> -->
                    <a href="{$_vkye_facebook}" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="{$_vkye_instagram}" target="_blank"><i class="fab fa-instagram"></i></a>
                    <!-- <a href="{$_vkye_twitter}" target="_blank"><i class="fab fa-twitter"></i></a> -->
                    <!-- <a href="{$_vkye_youtube}" target="_blank"><i class="fab fa-youtube"></i></a> -->
                </div>
            </div>
            <form name="contact">
                <fieldset class="fields-group">
                    <div class="warning">
                        <p><span class="required-field">*</span>{$lang.required_fields}</p>
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
                                <input type="text" name="email">
                            </div>
                        </div>
                        <div class="span6">
                            <div class="text">
                                <h6><span class="required-field">*</span>{$lang.phone}</h6>
                                <input type="text" name="phone">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>{$lang.message}</h6>
                        <textarea name="message"></textarea>
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="button">
                        <button type="submit">{$lang.send}</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </section>
</main>
