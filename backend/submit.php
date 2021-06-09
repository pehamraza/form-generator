
<?php

if(isset($_POST)){

    echo "
        <div class='row'>
        <div class='col-md-6'>
            <i class='fa fa-check fa-5x' style='color: green'></i><br>
            <h2>Received!</h2>
            <h3>Contact request has been received!</h3>
            <h5>We will get back to you as soon as possible!</h5>
        </div>
        <br>
        <div class='col-md-6'><div class='card card-body bg-light p-5'><h4>Received Information:</h4>";


    foreach ($_POST as $key => $value)
    {
        echo "<div><strong>".ucfirst($key)."</strong>: ".(!is_array($value) ? $value : json_encode($value))."</div>";
    }

    echo "</div></div></div><br><div><a href=''>Go Back</a></div>";

}else echo "Nothing to see here!";




