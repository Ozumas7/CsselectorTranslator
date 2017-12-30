<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 28/12/2017
 * Time: 4:07
 */

namespace Kolter\CsselectorTranslator;


class AttrQuery
{

    protected $attrName;
    protected $searchType;
    protected $attrSearch;

    /**
     * @return mixed
     */
    public function getAttrName()
    {
        return $this->attrName;
    }

    /**
     * @param mixed $attrName
     */
    public function setAttrName($attrName): void
    {
        $this->attrName = $attrName;
    }

    /**
     * @return mixed
     */
    public function getSearchType()
    {
        return $this->searchType;
    }

    /**
     * @param mixed $searchType
     */
    public function setSearchType($searchType): void
    {
        $this->searchType = $searchType;
    }

    /**
     * @return mixed
     */
    public function getAttrSearch()
    {
        return $this->attrSearch;
    }

    /**
     * @param mixed $attrSearch
     */
    public function setAttrSearch($attrSearch): void
    {
        $this->attrSearch = $attrSearch;
    }

    public function __toString() : string
    {
        $equal = ($this->attrSearch!=="") ? "=" : "";
        $type = ($this->attrSearch!=="") ? "$this->searchType" : "";
        return "[$this->attrName$type$equal$this->attrSearch]";
    }


}