<?php

defined('_EXEC') or die;

/**
* @package valkyrie.layouts.index
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since August 01 - 18, 2018 <@create>
* @version 1.0.0
* @summary cm-valkyrie-platform-website-template
*
* @author Gersón Aarón Gómez Macías <Chief Technology Officer, ggomez@codemonkey.com.mx>
* @since December 01 - 15, 2018 <@update>
* @version 1.1.0
* @summary cm-valkyrie-platform-website-template
*
* @copyright Copyright (C) Code Monkey <legal@codemonkey.com.mx, wwww.codemonkey.com.mx>. All rights reserved.
*/

$this->dependencies->add(['js', '{$path.js}Signup/index.min.js']);

?>

%{header}%
<section class="home" data-image-src="{$path.images}background.png">
    <figure>
        <img src="{$path.images}logotype_white.png" alt="Logotype">
    </figure>
    <h1>{$lang.index}</h1>
</section>
<section class="signup">
    <h2>{$lang.signup_now}</h2>
    <form name="signup">
        <fieldset class="fields-group">
            <p class="warning"><span class="required-field">*</span>{$lang.required_fields}</p>
        </fieldset>
        <fieldset class="fields-group">
            <div class="text">
                <h6><span class="required-field">*</span>{$lang.fullname}</h6>
                <input type="name" name="name">
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
                <h6><span class="required-field">*</span>{$lang.phone}</h6>
                <input type="text" name="phone">
            </div>
        </fieldset>
        <fieldset class="fields-group row">
            <div class="text span6">
                <h6><span class="required-field">*</span>{$lang.username}</h6>
                <input type="text" name="username">
            </div>
            <div class="text span6">
                <h6><span class="required-field">*</span>{$lang.password}</h6>
                <input type="password" name="password">
            </div>
        </fieldset>
        <button type="submit" class="btn btn-colored">{$lang.signup}</button>
    </form>
</section>
