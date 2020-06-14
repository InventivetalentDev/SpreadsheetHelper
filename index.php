<?php
// =IMPORTDATA("http://example.com/?type=<type>&path=<path>&from=<url>")

$from = $_GET["from"]; // URL
$type = $_GET["type"]; // what to do
$path = $_GET["path"]; // where to find it

header("Content-Type: text/plain");

if (!isset($from)) {
    die("missing URL");
}
if (!isset($type)) {
    die("missing type");
}

$ch = curl_init($from);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data = curl_exec($ch);
curl_close($ch);

if (empty($data)) {
    die("failed to get data");
}

if ($type === "json" || $type === "jsonobject" || $type === "jsonarray") {
    $json = json_decode($data, true);
    echo $json[$path];
} else {
    die("unsupported type");
}
