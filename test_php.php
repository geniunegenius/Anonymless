<?php

$output = "";

$string = "Da, ";
$user = $_POST['pref'];

$string .= $user + ";";

$output = "<script>alert('".$string."');</script>";
echo $output;
?>