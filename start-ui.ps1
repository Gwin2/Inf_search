$ErrorActionPreference = "Stop"
[Console]::OutputEncoding = [System.Text.Encoding]::UTF8
$OutputEncoding = [System.Text.Encoding]::UTF8

$Root = Split-Path -Parent $MyInvocation.MyCommand.Path
Set-Location $Root

$Port = 8080
$HostName = "127.0.0.1"
$Url = "http://${HostName}:$Port/index.html"

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
	Write-Host "PHP not found." -ForegroundColor Red
	Write-Host "Install PHP or XAMPP/OpenServer, then run:" -ForegroundColor Yellow
	Write-Host ".\start-ui.bat" -ForegroundColor Yellow
	Write-Host ""
	Write-Host "Static index.html can be opened manually, but PHP labs need PHP."
	exit 1
}

$MysqlServer = "C:\xampp\mysql\bin\mysqld.exe"
$MysqlConfig = "C:\xampp\mysql\bin\my.ini"

if ((Test-Path $MysqlServer) -and -not (Get-Process mysqld -ErrorAction SilentlyContinue)) {
	Write-Host "Starting MySQL..." -ForegroundColor Green
	Start-Process -FilePath $MysqlServer -ArgumentList "--defaults-file=$MysqlConfig" -WindowStyle Hidden
	Start-Sleep -Seconds 5
}

if (Test-Path "$Root\setup-demo-db.php") {
	Write-Host "Preparing study and sample databases..." -ForegroundColor Green
	& $Php "$Root\setup-demo-db.php"
}

$PortBusy = Get-NetTCPConnection -LocalPort $Port -ErrorAction SilentlyContinue
if ($PortBusy) {
	$Port = 8081
	$Url = "http://${HostName}:$Port/index.html"
}

Write-Host "Starting WebUI: $Url" -ForegroundColor Green
Start-Process $Url
Start-Process -FilePath $Php -ArgumentList @("-S", "$HostName`:$Port", "-t", $Root, "$Root\router.php") -WorkingDirectory $Root -WindowStyle Hidden
Write-Host "Done. Server runs in background." -ForegroundColor Green
