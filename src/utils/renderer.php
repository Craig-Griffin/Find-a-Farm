<?php

// The renderer has functions that allow a piece of template html to be rendered.
// Use handlebars syntax {{label}} in templates as non-terminal symbols that are replaced with actual content by the renderer.
// The renderer takes in an associative array (dictionary) of labels and content to replace the labels with,
// and replaces each occurence of a label surrounded by double curly braces with the content provided as a dictionary value.

if(!isset($RENDERER)) {
    $RENDERER = true;
    require "loginManager.php";

// if $data = array("name"=>"Rory Brown") and $template="<h1>Hi, my name is {{name}}</h1>"
// the output will be "<h1>Hi, my name is Rory Brown</h1>".

// Renders html from a file and outputs to a destination file.
    function renderFromFileToFile($inFilename, $outFilename, $data)
    {
        $rendered = renderFromFile($inFilename, $data);
        file_put_contents($outFilename, $rendered);
    }

// Renders html from a file, and a given data dictionary.
    function renderFromFile($filename, $data)
    {
        $template = file_get_contents($filename);
        $rendered = renderFromString($template, $data);
        return $rendered;
    }

// *USE THIS ONE TO RENDER PAGES FOR THE SITE*
// Renders html from a given filename in the templates directory and a given data dictionary.
    function renderFromTemplateFile($filename, $data)
    {
        $filepath = "templates/" . $filename;
        $rendered = renderFromFile($filepath, $data);
        return $rendered;
    }

// Renders html from a string and a given data dictionary.
    function renderFromString($template, $data)
    {
        $rendered = $template;
        foreach (getLabels($template) as $label) {
            if (!isset($data[$label])) {
                $data[$label] = "";
            }
        }
        foreach ($data as $label => $content) {
            $rendered = str_replace("{{" . $label . "}}", "{{{" . $label . "}}}", $rendered);
        }

        foreach ($data as $label => $content) {
            $rendered = str_replace("{{{" . $label . "}}}", $content, $rendered);
        }

        return $rendered;
    }

    function getLabels($string)
    {

        preg_match_all("{{[^{}]+}}", $string, $matches);

        foreach ($matches[0] as &$match) {
            $match = str_replace("{", "", $match);
            $match = str_replace("}", "", $match);
        }
        return $matches[0];

    }

    function renderError($message)
    {
        return renderFromTemplateFile("error.html", ["message" => $message]);
    }

    function renderNavbar()
    {
        if (isLoggedIn()) {
            return renderFromTemplateFile("navbarLoggedIn.html", []);
        } else {
            return renderFromTemplateFile("navbar.html", []);
        }
    }

    function renderHeader($data){
        $data["navbar"] = renderNavbar();
        return renderFromTemplateFile("header.html", $data);
    }

    function renderFooter(){
        return renderFromTemplateFile("footer.html", []);
    }

    function renderPageFromTemplateFile($filename, $data){
        $data["header"] = renderHeader($data);
        $data["footer"] = renderFooter();
        return renderFromTemplateFile($filename, $data);
    }
}