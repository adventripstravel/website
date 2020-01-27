<?php

defined('_EXEC') or die;

$this->dependencies->add(['js', '{$path.js}Terms/index.min.js']);

?>

%{header}%
<main class="terms">
    <section class="tr-st-1"></section>
    <section class="tr-st-2">
        <div class="container">
            {$terms_and_conditions}
        </div>
    </section>
</main>
