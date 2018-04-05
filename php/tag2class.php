<?php
    require_once "element.php";

    function get_tag2class(){
        $classes = array(
            'BaseHead',
            'Beanie',
            'Bowler',
            'BaseEyes',
            'GlassesEyes',
            'NormalEyes',
            'BaseNose',
            'MustacheNose',
            'RedNose',
            'BaseMouth',
            'CheekyMouth',
            'SmileMouth',
            'BaseFoot',
            'BlueFoot',
            'YellowFoot',
            'BaseLeft',
            'LeftHand',
            'Shovel',
            'FishingRod',
            'BaseRight',
            'RightHand'
        );

        $tag2class = array();
        foreach( $classes as $class ){
            $tmp = new $class();
            $tag2class[$tmp->get_tag()] = $class;
        }

        return $tag2class;
    }

?>