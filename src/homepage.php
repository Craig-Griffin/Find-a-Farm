<?php
require "utils/renderer.php";

$data = [];
$data["name"] = "Rory Brown";

echo renderFromTemplateFile("templates/index.html", $data);

?>
