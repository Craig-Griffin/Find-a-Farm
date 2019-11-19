<?php

if(!isset($UTILS)) {
    $UTILS = true;

    function postParam($label)
    {
        if (isset($_POST[$label])) {
            return $_POST[$label];
        }
        return "";
    }

    function getParam($label)
    {
        if (isset($_GET[$label])) {
            return $_GET[$label];
        }
        return "";
    }
}