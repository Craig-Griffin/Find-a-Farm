<?php
require "utils/renderer.php";

$data = [];
$data["name"] = "Rory Brown";

echo renderFromTemplateFile("header.php", $data);
echo renderFromTemplateFile("index.php", $data);
echo renderFromTemplateFile("footer.php", $data);

?>
