<?php
require "utils/renderer.php";

$data = [];
$data["name"] = "Rory Brown";

echo renderFromTemplateFile("index.html", $data);

?>
