<?php

if(!isset($LOGIN_MANAGER)) {
    $LOGIN_MANAGER = true;

    require "database.php";

    $PROFILE_PAGE = "profile.php";
    $NOT_LOGGED_IN_PAGE = "login.php";


    function requireNotLoggedIn()
    {
        global $PROFILE_PAGE;

        if (isLoggedIn()) {
            header("Location: $PROFILE_PAGE?id=" . $_SESSION["id"]);
        }
    }

    function requireLoggedIn()
    {
        global $NOT_LOGGED_IN_PAGE;

        if (!isLoggedIn()) {
            header("Location: $NOT_LOGGED_IN_PAGE");
        }
    }

    function isLoggedIn()
    {
        return isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] && isset($_SESSION["id"]);
    }

    function login($email, $password)
    {
        global $DB_NAME, $PROFILE_PAGE;
        $query = "SELECT * FROM $DB_NAME.users WHERE email='$email'";
        $result = queryDB($query);
        $entries = enumerateResult($result);
        foreach ($entries as $entry) {
            if (password_verify($password, $entry["hash"])) {
                $_SESSION["userId"] = $entry["userId"];
                $_SESSION["loggedIn"] = true;
                $_SESSION["email"] = $email;
                header("Location: $PROFILE_PAGE");
            }
        }
        return false;
    }

    function logout()
    {
        $_SESSION["id"] = null;
        $_SESSION["loggedin"] = false;
    }

    function signUp($email, $password)
    {
        global $PROFILE_PAGE;

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $email = strip_tags($email);
        $query = "INSERT INTO users VALUES($id, '$email', '$hash', FALSE)";
        queryDB($query);
        login($email, $password);
        return false;
    }
}