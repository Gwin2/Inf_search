<?php
$requested = $_GET["file"] ?? "";
$root = realpath(__DIR__);
$file = realpath(__DIR__ . DIRECTORY_SEPARATOR . str_replace(["/", "\\"], DIRECTORY_SEPARATOR, $requested));
$allowed = ["php", "inc", "htm", "html", "txt", "ps1", "bat"];

if (!$requested || !$file || !str_starts_with($file, $root) || !is_file($file)) {
	http_response_code(404);
	$title = "Файл не найден";
	$code = "Файл не найден";
} else {
	$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
	if (!in_array($ext, $allowed)) {
		http_response_code(403);
		$title = "Запрещенный тип файла";
		$code = "Запрещенный тип файла";
	} else {
		$title = $requested;
		$code = file_get_contents($file);
	}
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Код: <?php echo htmlspecialchars($title); ?></title>
	<style>
		body {
			margin: 0;
			background: #ffffff;
			color: #18202b;
			font: 14px/1.55 Consolas, "Courier New", monospace;
		}

		.header {
			position: sticky;
			top: 0;
			padding: 10px 14px;
			background: #fbfcfe;
			border-bottom: 1px solid #d7e0e8;
			color: #5d6b7a;
			font: 700 13px/1.2 "Segoe UI", Arial, sans-serif;
		}

		pre {
			margin: 0;
			padding: 16px;
			white-space: pre-wrap;
			word-break: break-word;
		}
	</style>
</head>
<body>
	<div class="header"><?php echo htmlspecialchars($title); ?></div>
	<pre><?php echo htmlspecialchars($code); ?></pre>
</body>
</html>
