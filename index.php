<?php
    require_once 'classes/Form.php';

echo '<div id="form">';

    $form_type = 'post'; // get or post
    $json_source = 'json/test.json';

    $form = new Form($form_type, '', $json_source);
    $form->generate();


    echo '</div>';



