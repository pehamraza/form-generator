<?php
require_once 'classes/Form.php';

if(isset($_POST)){

    $source = $_POST['source'];
    $method = $_POST['method'];
    $url = $_POST['url'];

    $form = new Form($method, $url, $source);

    $form->generate();
}




