<?php

require_once "init.php";
require_once "options.php";
require_once "tag2class.php";
require_once "element.php";
require_once "element_factory.php";

class Model {
    private $factory;
    private $element;

    public function __construct(){
        $this->factory = new ElementFactory();
        $this->factory->tag2class = get_tag2class();
        $this->factory->tag2options = get_options();
    }

    public function save(){
        return $this->element->get_xml()->asXML();
    }

    public function load($xml){
        $this->element = $this->factory->create($xml);
    }

    public function reset(){
        $this->element = $this->factory->create(NULL);
    }

    public function get_element(){
        return $this->element;
    }

    public function get_element_bytag($path){
        $curr = $this->element;
        foreach(explode(" ", $path) as $tag){
            $curr = $curr->get_child($tag);
        }
        return $curr;
    }

    public function set_child_bytag($path, $option=NULL){
        if($path !== "potato"){
            $elem = $this->get_element_bytag($path);
        } else {
            $elem = $this->get_element();
        }
        if($option !== NULL){
            $tags = explode(" ", $option);
            $first = array_shift($tags);
            $xml = simplexml_load_string("<$first/>");
            $curr = $xml;
            foreach( $tags as $tag ){
                $curr = $curr->addChild($tag);
            }
            $elem->add_child($this->factory->create($xml));
        } else {
            if($elem::$removable){
                $tags = explode(" ", $path);
                $last = array_pop($tags);
                $curr = $this->element;
                foreach($tags as $tag){
                    $curr = $curr->get_child($tag);
                }
                unset($curr->get_children()[$last]);
            }
        }
    }

    public function get_active_elements(){
        return self::list_elements($this->element);
    }

    public static function list_elements($element){
        $list = array();
        foreach($element->get_children() as $child){
            $tag = $child->get_tag();
            $list[] = $tag;
            foreach( self::list_elements($child) as $subtag ){
                $list[] = $tag . " " . $subtag;
            }
        }
        return $list;
    }

    public function get_element_options($path){
        $curr = $this->element;
        if($path === "potato"){
            return get_options()["potato"];
        }
        foreach(explode(" ", $path) as $tag){
            $curr = $curr->get_child($tag);
        }
        return $curr->get_options();
    }
}

?>
