<?php
$requested = $_GET["file"] ?? "";
$root = realpath(__DIR__);
$file = realpath(__DIR__ . DIRECTORY_SEPARATOR . str_replace(["/", "\\"], DIRECTORY_SEPARATOR, $requested));
$allowed = ["php", "inc", "htm", "html", "txt", "ps1", "bat"];
$canPreview = false;

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
		$canPreview = in_array($ext, ["php", "htm", "html", "txt"]);
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
			font-family: "Segoe UI", Arial, sans-serif;
			height: 100vh;
			overflow: hidden;
		}

		.header {
			height: 45px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			gap: 12px;
			padding: 10px 14px;
			background: #fbfcfe;
			border-bottom: 1px solid #d7e0e8;
			color: #5d6b7a;
			font: 700 13px/1.2 "Segoe UI", Arial, sans-serif;
		}

		.actions {
			display: flex;
			align-items: center;
			gap: 10px;
		}

		.status {
			color: #5d6b7a;
			font-size: 12px;
			font-weight: 700;
		}

		button {
			padding: 7px 10px;
			border: 0;
			border-radius: 6px;
			background: #0f766e;
			color: #ffffff;
			font: 700 12px/1 "Segoe UI", Arial, sans-serif;
			cursor: pointer;
		}

		button:hover {
			background: #0b5f59;
		}

		.workspace {
			height: calc(100vh - 45px);
			display: grid;
			grid-template-columns: minmax(320px, 1fr) minmax(320px, 1fr);
		}

		.editor,
		.result {
			min-width: 0;
			height: 100%;
		}

		.editor {
			border-right: 1px solid #d7e0e8;
		}

		textarea {
			width: 100%;
			height: 100%;
			display: block;
			margin: 0;
			padding: 16px;
			border: 0;
			outline: 0;
			resize: none;
			background: #ffffff;
			color: #18202b;
			font: 14px/1.55 Consolas, "Courier New", monospace;
			tab-size: 4;
		}

		iframe {
			width: 100%;
			height: 100%;
			border: 0;
			background: #ffffff;
		}

		.placeholder {
			margin: 0;
			padding: 16px;
			color: #5d6b7a;
		}

		@media (max-width: 900px) {
			.workspace {
				grid-template-columns: 1fr;
				grid-template-rows: 1fr 1fr;
			}

			.editor {
				border-right: 0;
				border-bottom: 1px solid #d7e0e8;
			}
		}
	</style>
</head>
<body>
	<div class="header">
		<span><?php echo htmlspecialchars($title); ?></span>
		<div class="actions">
			<span id="status" class="status">готово</span>
			<button id="save" type="button">Сохранить</button>
		</div>
	</div>
	<div class="workspace">
		<div class="editor">
			<textarea id="code" spellcheck="false"><?php echo htmlspecialchars($code); ?></textarea>
		</div>
		<div class="result">
<?php if ($canPreview) { ?>
			<iframe id="result" src="<?php echo htmlspecialchars($requested); ?>"></iframe>
<?php } else { ?>
			<p class="placeholder">Для этого типа файла доступно редактирование без предпросмотра.</p>
<?php } ?>
		</div>
	</div>
	<script>
		const file = <?php echo json_encode($requested); ?>;
		const code = document.getElementById("code");
		const status = document.getElementById("status");
		const save = document.getElementById("save");
		const result = document.getElementById("result");
		let timer = null;
		let saving = false;

		async function saveCode() {
			if (saving) return;
			saving = true;
			status.textContent = "сохранение...";

			try {
				const response = await fetch("save-code.php", {
					method: "POST",
					headers: { "Content-Type": "application/x-www-form-urlencoded;charset=UTF-8" },
					body: new URLSearchParams({ file, code: code.value })
				});
				const data = await response.json();
				if (!data.ok) throw new Error(data.error || "save failed");
				status.textContent = "сохранено";
				if (result) {
					const glue = file.includes("?") ? "&" : "?";
					result.src = file + glue + "_live=" + Date.now();
				}
			} catch (error) {
				status.textContent = "ошибка сохранения";
			} finally {
				saving = false;
			}
		}

		code.addEventListener("input", () => {
			status.textContent = "изменено";
			clearTimeout(timer);
			timer = setTimeout(saveCode, 700);
		});

		code.addEventListener("keydown", (event) => {
			if ((event.ctrlKey || event.metaKey) && event.key.toLowerCase() === "s") {
				event.preventDefault();
				clearTimeout(timer);
				saveCode();
			}

			if (event.key === "Tab") {
				event.preventDefault();
				const start = code.selectionStart;
				const end = code.selectionEnd;
				code.value = code.value.substring(0, start) + "\t" + code.value.substring(end);
				code.selectionStart = code.selectionEnd = start + 1;
			}
		});

		save.addEventListener("click", () => {
			clearTimeout(timer);
			saveCode();
		});
	</script>
</body>
</html>
