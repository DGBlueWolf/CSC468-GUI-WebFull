<?php

class Display{
    public static function selections($model, $paths){
        $str = "[\n";
        foreach( $paths as $path ){
            $file = $model->get_element_bytag($path)::$imagefile;
            $line = "[\"$path\", \"$file\"],\n";
            $str .= $line;
        }
        return $str . "\"end\"\n]";
    }

    public static function options($options, $tags2class){
        $str = "[\n";
        foreach( $options as $tag ){
            $name = $tags2class[end(explode(" ",$tag))];
            $file = $name::$imagefile;
            $line = "[\"$tag\", \"$file\"],\n";
            $str .= $line;
        }
        return $str . "\"end\"\n]";
    }

    public static function render($elem){
        $headfile = self::get_image_file($elem, 'head');
        $eyesfile = self::get_image_file($elem, 'eyes');
        $nosefile = self::get_image_file($elem, 'nose');
        $mouthfile = self::get_image_file($elem, 'mouth');
        $footfile = self::get_image_file($elem, 'feet');
        $leftfile = self::get_image_file($elem, 'leftside');
        $rightfile = self::get_image_file($elem, 'rightside');

        $json = <<<JSON
        "potato-head" : "$headfile",
        "potato-eyes" : "$eyesfile",
        "potato-nose" : "$nosefile",
        "potato-mouth": "$mouthfile",
        "potato-foot" : "$footfile",
        "potato-left" : "$leftfile",
        "potato-right": "$rightfile"
JSON;
        return "{\n" . $json . "\n}\n";
    }

    public static function getleaf($elem){
        $children = $elem->get_children();
        if(sizeof($children) == 0){
            return $elem;
        } else {
            $key = array_keys($children)[0];
            return self::getleaf($elem->get_children()[$key]);
        }
    }

    public static function get_image_file($elem, $tag){
        return self::getleaf($elem->get_child($tag))::$imagefile;
    }
}

?>