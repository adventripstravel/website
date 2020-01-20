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
                <span>{$_vkye_email}</span>
                <span>{$_vkye_phone}</span>
                <span>{$_vkye_tripadvisor}</span>
                <span>{$_vkye_facebook}</span>
                <span>{$_vkye_instagram}</span>
                <span>{$_vkye_twitter}</span>
                <span>{$_vkye_youtube}</span>
            </div>
            <form name="contact">
                <fieldset class="fields-group">
                    <p class="warning"><span class="required-field">*</span>{$lang.required_fields}</p>
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
                    <div class="text">
                        <h6><span class="required-field">*</span>{$lang.subject}</h6>
                        <input type="text" name="subject">
                    </div>
                </fieldset>
                <fieldset class="fields-group">
                    <div class="text">
                        <h6><span class="required-field">*</span>{$lang.email}</h6>
                        <input type="email" name="email">
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
