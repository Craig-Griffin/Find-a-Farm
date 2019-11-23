<?php
require "utils/renderer.php";

$data = [];
$data["name"] = "Rory Brown";

echo renderPageFromTemplateFile("index.html", $data);

?>
