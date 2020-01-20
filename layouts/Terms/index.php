<?php

defined('_EXEC') or die;

$this->dependencies->add(['js', '{$path.js}Terms/index.min.js']);

?>

%{header}%
{$terms_and_conditions}
