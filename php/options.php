<?php
    function get_options(){
        return array(
            'potato' => array(
                'head', 'eyes', 'nose', 'mouth', 'feet', 'leftside', 'rightside',
                'head bowler', 'head beanie',
                'eyes normal', 'eyes glasses',
                'nose red', 'nose mustache',
                'mouth smile', 'mouth cheeky',
                'feet blue', 'feet yellow',
                'leftside lefthand', 'leftside lefthand shovel', 'leftside lefthand rod',
                'rightside righthand',
            ),
            'head' => array('bowler', 'beanie'),
            'eyes' => array('normal', 'glasses'),
            'nose' => array('red', 'mustache'),
            'mouth' => array('cheeky', 'smile'),
            'feet' => array('blue', 'yellow'),
            'leftside' => array('lefthand', 'lefthand shovel', 'lefthand rod'),
            'rightside' => array('righthand'),
            'lefthand' => array('shovel', 'rod'),
        );
    }
?>