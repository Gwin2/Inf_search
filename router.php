<?php
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$file = realpath(__DIR__ . DIRECTORY_SEPARATOR . ltrim($path, "/\\"));
$root = realpath(__DIR__);

if ($file && str_starts_with($file, $root) && is_file($file)) {
	$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
	$is_code_request = isset($_SERVER["HTTP_SEC_FETCH_DEST"])
		&& $_SERVER["HTTP_SEC_FETCH_DEST"] === "empty"
		&& in_array($ext, ["php", "inc", "htm", "html", "txt", "ps1", "bat"]);

	if ($is_code_request) {
		header("Content-Type: text/plain; charset=utf-8");
		readfile($file);
		return true;
	}
}

return false;
?>
