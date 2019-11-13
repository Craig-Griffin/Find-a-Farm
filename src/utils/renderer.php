<?php

// The renderer has functions that allow a piece of template html to be rendered.
// Use handlebars syntax {{label}} in templates as non-terminal symbols that are replaced with actual content by the renderer.
// The renderer takes in an associative array (dictionary) of labels and content to replace the labels with,
// and replaces each occurence of a label surrounded by double curly braces with the content provided as a dictionary value.

// if $data = array("name"=>"Rory Brown") and $template="<h1>Hi, my name is {{name}}</h1>"
// the output will be "<h1>Hi, my name is Rory Brown</h1>".

// Renders html from a file and outputs to a destination file.
function renderFromFileToFile($inFilename, $outFilename, $data){
	$rendered = renderFromFile($inFilename, $data);
	file_put_contents($outFilename, $rendered);
}

// Renders html from a file, and a given data dictionary.
function renderFromFile($filename, $data){
	$template = file_get_contents($filename);
	$rendered = renderFromString($template, $data);
	return $rendered;
}

// *USE THIS ONE TO RENDER PAGES FOR THE SITE*
// Renders html from a given filename in the templates directory and a given data dictionary.
function renderFromTemplateFile($filename, $data){
	$filepath = "templates/".$filename;
	$rendered = renderFromFile($filepath, $data);
	return $rendered;
}

// Renders html from a string and a given data dictionary.
function renderFromString($template, $data){
	$rendered = $template;
	foreach($data as $label => $content){
		$rendered = str_replace("{{".$label."}}", "{{{".$label."}}}", $rendered);
	}

	foreach($data as $label => $content){
		$rendered = str_replace("{{{".$label."}}}", $content, $rendered);
	}

	return $rendered;
}

?>