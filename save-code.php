<?php
header("Content-Type: application/json; charset=utf-8");

$requested = $_POST["file"] ?? "";
$code = $_POST["code"] ?? "";
$root = realpath(__DIR__);
$target = __DIR__ . DIRECTORY_SEPARATOR . str_replace(["/", "\\"], DIRECTORY_SEPARATOR, $requested);
$file = realpath($target);
$allowed = ["php", "inc", "htm", "html", "txt", "ps1", "bat"];

if (!$requested || !$file || !str_starts_with($file, $root) || !is_file($file)) {
	echo json_encode(["ok" => false, "error" => "file not found"]);
	exit;
}

$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
if (!in_array($ext, $allowed)) {
	echo json_encode(["ok" => false, "error" => "forbidden file type"]);
	exit;
}

if (file_put_contents($file, $code) === false) {
	echo json_encode(["ok" => false, "error" => "write failed"]);
	exit;
}

echo json_encode(["ok" => true]);
?>
