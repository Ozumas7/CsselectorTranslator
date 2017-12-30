<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 28/12/2017
 * Time: 3:57
 */

namespace Kolter\CsselectorTranslator;


class CsselectorTranslator
{

    /**
     * @var string
     */
    private $query;

    static protected $ELEMENTREGEX = "/(?<type>[.#)]{1})?(?<typename>[\w_\-\d]{1,})(?<selector>:{1,2}[\w\-\(\)0-9]*)?(?<attrs>\[(.*\]))?(?<union>[>+~ ,.#]{1})?/";

    public function __construct(string $query)
    {
        $this->query = $this->formatQuery($query);
    }

    /**
     * @var Element currElement
     * @return array
     * @throws FormatCsselectorException
     */
    public function parse() : array
    {
        $elements = [];
        if(preg_match_all(self::$ELEMENTREGEX,$this->query,$arr)) {
            $currElement = null;
            $nextIsClassOrId = null;
            foreach ($arr["type"] as $key => $value) {
                $isAnElement = true;
                $element = ElementFactory::createElementByRegexpArray($arr, $key);
                if ($nextIsClassOrId !== null) {
                    if ($nextIsClassOrId === "#") $currElement->setId($element->getTag());
                    if ($nextIsClassOrId === ".") $currElement->addClass($element->getTag());
                    $isAnElement = false;
                    $currElement->setUnionType($element->getUnionType());
                }
                if ($element->getUnionType() === "." or $element->getUnionType() === "#") {
                    $nextIsClassOrId = $element->getUnionType();
                } else {
                    $nextIsClassOrId = null;

                }
                if ($isAnElement) {
                    if (is_null($currElement) and $isAnElement) {
                        $currElement = $element;
                    } else {
                        $currElement->setUnionElement($element);
                        $currElement = $element;
                    }
                    $elements[] = $element;
                }
            }
        }else{
            throw new FormatCsselectorException();
        }
        return $elements;
    }

    private function formatQuery($query) : string
    {
        $result = $query;
        $result = preg_replace('!\s+!', ' ', trim($query));
        $result = preg_replace('/\s+([>+~ ,.])\s+/', '${1}', $result);

        return $result;
    }

}