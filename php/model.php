<?php

require_once "element_factory.php";

class Model {
    private $factory = new ElementFactory();
    private $element;

    public function save(){
        return $this->element->get_xml()->__toString();
    }

    public function load( $xml ){
        $this->element = $factory->create($xml);
    }

    public function reset(){
        $this->element = $factor->create(NULL);
    }
}

?>
