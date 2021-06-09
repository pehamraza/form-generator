<?php
    require_once 'Form.php';

echo '<div id="form">';

    $form_type = 'post'; // get or post
    $json_source = 'test.json';

    $form = new Form($form_type, '', $json_source);
    $form->generate();


    echo '</div>';



