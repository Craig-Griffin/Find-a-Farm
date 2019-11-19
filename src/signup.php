<?php
require "utils/renderer.php";
require "utils/loginManager.php";
require "utils/utils.php";

function handleGet(){
    return [];
}

function handlePost(){
    $errors = "";

    $submit = true;

    $email = postParam("email");
    if($email == ""){
        $errors .= renderError("Please enter an email.");
        $submit = false;
    }
    $password = postParam("password");
    if($password == ""){
        $errors .= renderError("Please enter a password.");
        $submit = false;
    }
    $firstName = postParam("firstName");
    if($firstName == ""){
        $errors .= renderError("Please enter a first name.");
        $submit = false;
    }
    $lastName = postParam("lastName");
    if($lastName == ""){
        $errors .= renderError("Please enter a last name.");
        $submit = false;
    }

    if($submit){
        if(!signUp($email, $password)){
            $errors .= renderError("There was an unknown error while creating your account.");
        }
    }

    $data = [
        "errors" => $errors,
        "email" => $email,
        "password" => $password,
        "firstName" => $firstName,
        "lastName" => $lastName,
    ];

    return $data;
}

requireNotLoggedIn();

$_SERVER["REQUEST_METHOD"] = "POST";
$_POST["firstName"] = "rory";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = handlePost();
}
else{
    $data = handleGet();
}

echo renderPageFromTemplateFile("signup.html", $data);