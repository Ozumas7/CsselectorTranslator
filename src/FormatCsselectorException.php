<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 30/12/2017
 * Time: 3:44
 */

namespace Kolter\CsselectorTranslator;


use Throwable;

class FormatCsselectorException extends \Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        if($message==="") $message = "The format of the Csselector is wrong, please check it out";
        parent::__construct($message, $code, $previous);
    }
}