$ErrorActionPreference = "Stop"
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8
$OutputEncoding = [System.Text.Encoding]::UTF8

$Root = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $Root

$Port = 8080
$Url = "http://localhost:$Port/index.html"

$PhpCandidates = @(
	"php",
	"C:\xampp\php\php.exe",
	"C:\OSPanel\modules\php\PHP_8.3\php.exe",
	"C:\OSPanel\modules\php\PHP_8.2\php.exe",
	"C:\OSPanel\modules\php\PHP_8.1\php.exe",
	"C:\OpenServer\modules\php\PHP_8.3\php.exe",
	"C:\OpenServer\modules\php\PHP_8.2\php.exe",
	"C:\OpenServer\modules\php\PHP_8.1\php.exe"
)

$Php = $null
foreach ($Candidate in $PhpCandidates) {
	if ($Candidate -eq "php") {
		$Command = Get-Command php -ErrorAction SilentlyContinue
		if ($Command) {
			$Php = $Command.Source
			break
		}
	} elseif (Test-Path $Candidate) {
		$Php = $Candidate
		break
	}
}

if (-not $Php) {
	Write-Host "PHP не найден." -ForegroundColor Red
	Write-Host "Установи PHP или XAMPP/OpenServer, затем повтори команду:" -ForegroundColor Yellow
	Write-Host ".\start-ui.bat" -ForegroundColor Yellow
	Write-Host ""
	Write-Host "Статический index.html можно открыть вручную, но PHP-лабораторные без PHP не выполнятся."
	exit 1
}

$PortBusy = Get-NetTCPConnection -LocalPort $Port -ErrorAction SilentlyContinue
if ($PortBusy) {
	$Port = 8081
	$Url = "http://localhost:$Port/index.html"
}

Write-Host "Запуск WebUI: $Url" -ForegroundColor Green
Start-Process $Url
& $Php -S "localhost:$Port" -t $Root
