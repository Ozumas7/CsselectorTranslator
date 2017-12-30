<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 30/12/2017
 * Time: 3:54
 */

namespace Kolter\CsselectorTranslator\Tests;


use Kolter\CsselectorTranslator\Element;

class CsselectorTranslatorTest extends AbstractTestClass
{

    /**
     *
     */
    public function testMultipleClassElement()
    {
        $query = "p.one.two.three.four";
        $elements = $this->getTranslator($query);

        $this->assertTrue(sizeof($elements[0]->getClasses())===4);
    }

    /**
     *
     */
    public function testElementSelector()
    {
        $selector1 = ":first-child";
        $selector2 = ":nth-child(2)";

        $query = "p$selector1 li$selector2";
        $elements = $this->getTranslator($query);

        $this->assertTrue($elements[0]->getSelector()===$selector1);
        $this->assertTrue($elements[1]->getSelector()===$selector2);
    }

    /**
     *
     */
    public function testSeparablesElement()
    {
        $separable = [">","+","~"," ",","];
        $tag = ["p","q","r"];
        foreach ($separable as $value){
            $query = $tag[0].$value.$tag[1].$value.$tag[2];
            $elements = $this->getTranslator($query);
            for($i=0;$i<2;$i++){
                $curr = $elements[$i];
                $this->assertTrue($curr->getTag()===$tag[$i]);
                $this->assertTrue($curr->getUnionType()===$value);
                $this->assertTrue($curr->getUnionElement()===$elements[$i+1]);
            }
        }

    }

}