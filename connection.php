<?php
$con= mysqli_connect('localhost' ,'root', '', 'koffee');
if(!$con)
{
    die(mysqli_errno($con));
}

