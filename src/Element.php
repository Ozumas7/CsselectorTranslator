<?php
/**
 * Created by PhpStorm.
 * User: Pablo
 * Date: 28/12/2017
 * Time: 4:03
 */

namespace Kolter\CsselectorTranslator;


class Element
{
    protected $tag;
    protected $id;
    protected $classes=[];
    protected $unionType;
    protected $unionElement;
    protected $selector;
    protected $attrQueries = [];

    /**
     * Element constructor.
     * @param $tag
     * @param $id
     * @param $classes
     * @param $unionType
     * @param $unionElement
     * @param $selector
     * @param array $attrQueries
     */
    public function __construct($tag, $id, $classes, $unionType, $unionElement, $selector, array $attrQueries)
    {
        $this->tag = $tag;
        $this->id = $id;
        $this->classes = $classes;
        $this->unionType = $unionType;
        $this->unionElement = $unionElement;
        $this->selector = $selector;
        $this->attrQueries = $attrQueries;
    }


    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param mixed $tag
     */
    public function setTag($tag): void
    {
        $this->tag = $tag;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return array
     */
    public function getClasses(): array
    {
        return $this->classes;
    }

    /**
     * @param array $classes
     * @return Element
     */
    public function setClasses(array $classes): Element
    {
        $this->classes = $classes;
        return $this;
    }

    public function addClass(?string $classe)
    {
        if($classe === null) return $this;
        $this->classes[] = $classe;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnionType()
    {
        return $this->unionType;
    }

    /**
     * @param mixed $unionType
     */
    public function setUnionType($unionType): void
    {
        $this->unionType = $unionType;
    }

    /**
     * @return mixed
     */
    public function getUnionElement()
    {
        return $this->unionElement;
    }

    /**
     * @param mixed $unionElement
     */
    public function setUnionElement($unionElement): void
    {
        $this->unionElement = $unionElement;
    }

    /**
     * @return mixed
     */
    public function getSelector()
    {
        return $this->selector;
    }

    /**
     * @param mixed $selector
     */
    public function setSelector($selector): void
    {
        $this->selector = $selector;
    }

    /**
     * @return array
     */
    public function getAttrQueries(): array
    {
        return $this->attrQueries;
    }

    /**
     * @param array $attrQueries
     */
    public function setAttrQueries(array $attrQueries): void
    {
        $this->attrQueries = $attrQueries;
    }


    public function __toString() : string
    {
        $class = $this->strClasses();
        $id = ($this->id===null) ? "" : "#$this->id";
        return "$this->tag$class$id$this->selector".$this->strAttrQueries()."$this->unionType$this->unionElement";
    }

    private function strAttrQueries()
    {
        $result = "";
        foreach($this->getAttrQueries() as $key=>$value){
            $result.="$value";
        }
        return $result;
    }

    private function strClasses()
    {
        $result ="";
        foreach($this->classes as $value){
            $result.=".$value";
        }
        return $result;
    }

}