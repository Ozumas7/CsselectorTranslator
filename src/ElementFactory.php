<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 30/12/2017
 * Time: 3:10
 */

namespace Kolter\CsselectorTranslator;


class ElementFactory
{

    static protected $ATTRQUERYELEMENT = "/(\[(?<attrname>[\w_-]*)(?<searchtype>[\^$|*~]{1})?=(?<attrsearch>[^\]]*)\])/";

    public static function createElementByRegexpArray($arr,$key)
    {

        $tag = $arr["type"][$key]=="" ? $arr["typename"][$key] : null;
        $class = ($arr["type"][$key]===".")? $arr["typename"][$key] : null;
        $id = ($arr["type"][$key]==="#")? $arr["typename"][$key] : null;
        $selector = $arr["selector"][$key];
        $unionType = $arr["union"][$key]!=="" ? $arr["union"][$key] : null;
        $attrs = self::parseAttrQueries($arr["attrs"][$key]);
        $element = new Element($tag,$id,[],$unionType,null,$selector,$attrs);
        $element->addClass($class);

        return $element;
    }


    private static function parseAttrQueries($key)
    {
        $attrqueries = [];
        if($key==="") return $attrqueries;
        if(preg_match_all(self::$ATTRQUERYELEMENT,$key,$arr)){
            foreach($arr["attrname"] as $key=>$value){
                $attrquery = new AttrQuery();
                $attrquery->setAttrName($value);
                $attrquery->setAttrSearch($arr["attrsearch"][$key]);
                $attrquery->setSearchType($arr["searchtype"][$key]);
                $attrqueries[] = $attrquery;
            }
            return $attrqueries;
        }
    }
}