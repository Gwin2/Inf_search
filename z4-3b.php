<?php
$user = $_GET["user"] ?? "";
$answer = $_GET["answer"] ?? [];
$otv = ["6", "9", "4", "1", "3", "2", "5", "8", "7"];
$count = 0;

for ($i = 0; $i < count($otv); $i++) {
	if (($answer[$i] ?? "") == $otv[$i]) {
		$count++;
	}
}

switch ($count) {
	case 9:
		$result = "великолепно знаете географию";
		break;
	case 8:
		$result = "отлично знаете географию";
		break;
	case 7:
		$result = "очень хорошо знаете географию";
		break;
	case 6:
		$result = "хорошо знаете географию";
		break;
	case 5:
		$result = "удовлетворительно знаете географию";
		break;
	case 4:
		$result = "терпимо знаете географию";
		break;
	case 3:
		$result = "плохо знаете географию";
		break;
	case 2:
		$result = "очень плохо знаете географию";
		break;
	default:
		$result = "вообще не знаете географию";
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Результат теста</title>
</head>
<body>
	<p><?php echo htmlspecialchars($user); ?>, вы <?php echo $result; ?>.</p>
	<p>Количество правильных ответов: <?php echo $count; ?></p>
	<p><a href="z4-3a.htm">Назад</a></p>
</body>
</html>
