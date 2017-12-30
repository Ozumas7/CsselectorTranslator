<?php


namespace Kolter\CsselectorTranslator\Tests;


use Kolter\CsselectorTranslator\CsselectorTranslator;


abstract class AbstractTestClass extends \PHPUnit_Framework_TestCase
{
    public function getTranslator(string $query){
        $result = new CsselectorTranslator($query);

        return $result->parse();
    }
}