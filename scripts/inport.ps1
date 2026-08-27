<#
    Importa o site + o banco de dados MySQL (login_app) nesta maquina,
    a partir da pasta gerada por exportar-projeto.ps1.

    Uso (na maquina de destino, com XAMPP instalado e Apache/MySQL ligados):
        powershell -ExecutionPolicy Bypass -File importar-projeto.ps1 -OrigemDir "D:\login-export"

    Onde D:\login-export e a pasta copiada do pendrive, contendo:
        - login-site.zip
        - login_app.sql
#>

param(
    [Parameter(Mandatory = $true)]
    [string]$OrigemDir,
    [string]$MysqlBin  = "C:\xampp\mysql\bin",
    [string]$HtdocsDir = "C:\xampp\htdocs",
    [string]$DbUser    = "root",
    [string]$DbPass    = ""
)

$ErrorActionPreference = "Stop"

$zipFile = Join-Path $OrigemDir "login-site.zip"
$sqlFile = Join-Path $OrigemDir "login_app.sql"
$mysqlExe = Join-Path $MysqlBin "mysql.exe"

if (-not (Test-Path $zipFile)) { Write-Error "Nao encontrei '$zipFile'."; exit 1 }
if (-not (Test-Path $sqlFile)) { Write-Error "Nao encontrei '$sqlFile'."; exit 1 }
if (-not (Test-Path $mysqlExe)) {
    Write-Error "mysql.exe nao encontrado em '$MysqlBin'. Ajuste -MysqlBin se o XAMPP estiver em outro local."
    exit 1
}

$destino = Join-Path $HtdocsDir "login"

Write-Host "1/3 - Preparando pasta de destino..." -ForegroundColor Cyan
if (Test-Path $destino) {
    $backup = Join-Path $HtdocsDir ("login_backup_{0}" -f (Get-Date -Format "yyyyMMdd_HHmmss"))
    Write-Host "    Ja existe uma pasta 'login'. Movendo para: $backup"
    Move-Item -Path $destino -Destination $backup
}

Write-Host "2/3 - Extraindo o site para '$destino'..." -ForegroundColor Cyan
$tempExtract = Join-Path $env:TEMP ("login-import-{0}" -f (Get-Random))
Expand-Archive -Path $zipFile -DestinationPath $tempExtract -Force

$extractedLoginFolder = Join-Path $tempExtract "login"
if (Test-Path $extractedLoginFolder) {
    Move-Item -Path $extractedLoginFolder -Destination $destino
} else {
    Move-Item -Path $tempExtract -Destination $destino
}
Remove-Item $tempExtract -Recurse -Force -ErrorAction SilentlyContinue

Write-Host "3/3 - Importando o banco de dados..." -ForegroundColor Cyan
$mysqlArgs = @("-u", $DbUser)
if ($DbPass -ne "") {
    $mysqlArgs += "--password=$DbPass"
}

Get-Content -Raw -Path $sqlFile | & $mysqlExe @mysqlArgs
if ($LASTEXITCODE -ne 0) {
    Write-Error "Falha ao importar o banco. Verifique se o MySQL do XAMPP esta rodando e as credenciais (-DbUser/-DbPass)."
    exit 1
}

Write-Host ""
Write-Host "Importacao concluida!" -ForegroundColor Green
Write-Host "Site copiado para: $destino"
Write-Host "Banco 'login_app' importado com sucesso."
Write-Host "Acesse em: http://localhost/login/index.php"
