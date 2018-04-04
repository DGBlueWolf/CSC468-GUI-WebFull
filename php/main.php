<?php

require_once "model.php";
require_once "display.php";

$model = new Model();
$display = new Display();

switch($_POST['action']){
    case "init":
        echo init_session();
        break;

    case "save":
        echo $model->save();
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

function handle_reset(){
    $model-reset();
    return $display->render($model->element);
}

function handle_xml_upload(){
    $model->load(simplexml_load_file($_FILES['potato']['tmp_name']));
    return $display->render($model->element);
}

function handle_load_preset(){
    switch($_POST['preset']){
        case "default":
            $xml = simplexml_load_file('presets/default.xml');
            break;

        case "frosh":
            $xml = simplexml_load_file('presets/frosh.xml');
            break;

        default:
            $xml = NULL;
    }

    $model->load($xml);
    return $display->render($model->element);
}

function handle_element_action(){
    switch($_POST['action-type']){
        case "replace":
            handle_element_replace();
            break;

        case "add":
            handle_element_add();
            break;

        case "remove":
            handle_element_remove();
            break;

        default:
            die("Error: Unimplemented element action.");
    }
}
?>