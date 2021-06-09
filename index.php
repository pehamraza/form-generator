<?php
    require_once 'Form.php';

    $form_type = 'get';
    $json_source = 'source.json';

    $form = new Form($form_type, $json_source);
    $form->generate();

    if($form_type == 'get')
        $data = $_GET;
    else $data = $_POST;

    if(isset($data)){
        echo "<pre>";
        print_r($data);
    }




