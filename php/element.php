<?php

class Element{
    public static $tag = NULL;
    public static $removable = true;
    public static $imagefile = NULL;
    private $options;
    private $children;

    public function __construct(){
        $this->options = array();
        $this->children = array();
    }

    public function get_tag(){
        return $this::$tag;
    }

    public function get_xml($parent=NULL){
        if($parent === NULL){
            $parent = simplexml_load_string("<" . $this::$tag . "/>");
            $child = $parent;
        } else {
            $child = $parent->addChild($this::$tag);
        }
        foreach( $this->children as $elem ){
            $elem->get_xml($child);
        }
        return $parent;
    }

    public function add_option($elem_class){
        $this->options[] = $elem_class;
    }

    public function get_options(){
        return $this->options;
    }

    public function add_child($elem){
        $this->children[$elem::$tag] = $elem;
    }

    public function get_child($tag){
        return $this->children[$tag];
    }

    public function get_children(){
        return $this->children;
    }
}

class Fixed extends Element {
    public static $removable = false;
}

class Potato extends Fixed {
    public static $tag = "potato";
    public static $imagefile = NULL;
}

class BaseHead extends Fixed {
    public static $tag = "head";
    public static $imagefile = "images/base_head.png";
}

class Beanie extends Element {
    public static $tag = "beanie";
    public static $imagefile = "images/beanie_head.png";
}

class Bowler extends Element {
    public static $tag = "bowler";
    public static $imagefile = "images/bowler_head.png";
}

class BaseEyes extends Fixed {
    public static $tag = "eyes";
    public static $imagefile = "images/base_eyes.png";
}

class GlassesEyes extends Element {
    public static $tag = "glasses";
    public static $imagefile = "images/glasses_eyes.png";
}

class NormalEyes extends Element {
    public static $tag = "normal";
    public static $imagefile = "images/normal_eyes.png";
}

class BaseNose extends Fixed {
    public static $tag = "nose";
    public static $imagefile = "images/base_nose.png";
}

class MustacheNose extends Element {
    public static $tag = "mustache";
    public static $imagefile = "images/mustache_nose.png";
}

class RedNose extends Element {
    public static $tag = "red";
    public static $imagefile = "images/red_nose.png";
}

class BaseMouth extends Fixed {
    public static $tag = "mouth";
    public static $imagefile = "images/base_mouth.png";
}

class CheekyMouth extends Element {
    public static $tag = "cheeky";
    public static $imagefile = "images/cheeky_mouth.png";
}

class SmileMouth extends Element {
    public static $tag = "smile";
    public static $imagefile = "images/smile_mouth.png";
}

class BaseFoot extends Fixed {
    public static $tag = "feet";
    public static $imagefile = "images/base_foot.png";
}

class BlueFoot extends Element{
    public static $tag = "blue";
    public static $imagefile = "images/blue_foot.png";
}

class YellowFoot extends Element{
    public static $tag = "yellow";
    public static $imagefile = "images/yellow_foot.png";
}

class BaseLeft extends Fixed {
    public static $tag = "leftside";
    public static $imagefile = "images/base_left.png";
}

class LeftHand extends Element {
    public static $tag = "lefthand";
    public static $imagefile = "images/left_hand.png";
}

class Shovel extends Element {
    public static $tag = "shovel";
    public static $imagefile = "images/shovel_inHand.png";
}

class FishingRod extends Element {
    public static $tag = "rod";
    public static $imagefile = "images/rod_inHand.png";
}

class BaseRight extends Fixed {
    public static $tag = "rightside";
    public static $imagefile = "images/base_right.png";
}

class RightHand extends Element {
    public static $tag = "righthand";
    public static $imagefile = "images/right_hand.png";
}
?>