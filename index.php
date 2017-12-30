<?php

use Kolter\CsselectorTranslator\CsselectorTranslator;

include "vendor/autoload.php";

$query = "/\////";
$css = new CsselectorTranslator($query);

$elements = $css->parse();