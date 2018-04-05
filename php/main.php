<?php

require_once "model.php";
require_once "options.php";
require_once "tag2class.php";
require_once "element.php";
require_once "element_factory.php";
require_once "display.php";

session_start();

switch($_POST['action']){
    case "init":
        echo init_session();
        break;

    case "save":
        echo handle_save();
        break;

    case "reset":
        echo handle_reset();
        break;

    case "load":
        echo handle_xml_upload();
        break;

    case "preset":
        echo handle_load_preset();
        break;

    case "element":
        echo handle_element_action();
        break;

    default:
        die("Error: Unimplemented action.");
}

function init_session(){
    //$_SESSION['model'] = NULL;
    if( !isset($_SESSION['model']) ){
        $_SESSION['model'] = new Model();
        return "false";
    } else {
        return Display::render($_SESSION['model']->get_element());
    }
}

function handle_save(){
    return $_SESSION['model']->save();
}

function handle_reset(){
    $_SESSION['model']->reset();
    return Display::render($_SESSION['model']->get_element());
}

function handle_xml_upload(){
    $xml = simplexml_load_file($_FILES['potato']['tmp_name']);
    $_SESSION['model']->load($xml);
    return Display::render($_SESSION['model']->get_element());
}

function handle_load_preset(){
    switch($_POST['preset']){
        case "default":
            $xml = simplexml_load_file('../presets/default.xml');
            break;

        case "frosh":
            $xml = simplexml_load_file('../presets/frosh.xml');
            break;

        default:
            $xml = NULL;
            break;
    }

    $_SESSION['model']->load($xml);
    return Display::render($_SESSION['model']->get_element());
}

function handle_element_action(){
    switch($_POST['action-type']){
        case "add":
            $path = $_POST['selection'];
            $opt = $_POST['option'];
            $_SESSION['model']->set_child_bytag($path,$opt);
            return Display::render($_SESSION['model']->get_element());
            break;

        case "remove":
            $path = $_POST['selection'];
            $_SESSION['model']->set_child_bytag($path);
            return Display::render($_SESSION['model']->get_element());
            break;

        case "select":
            $model = $_SESSION['model'];
            $paths = $_SESSION['model']->get_active_elements();
            return Display::selections($model, $paths);

        case "option":
            $path = $_POST['element-path'];
            $options = $_SESSION['model']->get_element_options($path);
            return Display::options($options, get_tag2class());

        default:
            die("Error: Unimplemented element action.");
    }
}

?>