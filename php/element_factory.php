<?php 

require_once "element.php";

class ElementFactory {
    public $tag2class;
    public $tag2options;

    public function __construct(){
        $this->tag2class = array();
    }

    public function create($xml){
        if(!isset($xml) || $xml->getName() === "potato"){
            $elem = new Potato();
            $elem->add_child(new BaseHead());
            $elem->add_child(new BaseEyes());
            $elem->add_child(new BaseNose());
            $elem->add_child(new BaseMouth());
            $elem->add_child(new BaseFoot());
            $elem->add_child(new BaseLeft());
            $elem->add_child(new BaseRight());
            foreach( $elem->get_children() as $tag => $child ){
                if(array_key_exists($tag, $this->tag2options)){
                    foreach( $this->tag2options[$tag] as $option ){
                        $child->add_option($option);
                    }
                }
            }
        } else {
            $elem = new $this->tag2class[$xml->getName()]();
            if(array_key_exists($elem->get_tag(), $this->tag2options)){
                foreach( $this->tag2options[$elem->get_tag()] as $option ){
                    $elem->add_option($option);
                }
            }
        }
        if(!isset($xml)){
            return $elem;
        }
        foreach( $xml->children() as $childxml){
            $child = $this->create($childxml);
            $elem->add_child($child);
        }
        return $elem;
        
    }
}

?>