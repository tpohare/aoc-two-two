<?php

require_once "vendor/autoload.php";

function check($function, $result) {
    $a = $function;

    if ($a === $result) {
        return "Passed";
    } else {
        return "Failed: $a != $result";
    }
}