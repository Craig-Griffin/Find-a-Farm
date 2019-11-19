<?php

if(!isset($DATABASE)) {
    $DATABASE = true;

    $SERVER_NAME = "devweb2019.cis.strath.ac.uk";
    $LOGIN_USERNAME = "cs312d";
    $LOGIN_PASSWORD = "aitaif4Aph8o";
    $DB_NAME = $LOGIN_USERNAME;

    function queryDB($query)
    {
        global $db;
        return $db->query($query);
    }

    function enumerateResult($result)
    {
        $entries = [];
        $entry = $result->fetch_assoc();

        while ($entry != null) {
            $entries = array_push($entries, $entry);
            $entry = $result->fetch_assoc();
        }
        return $entries;
    }
}