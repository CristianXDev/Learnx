@echo off
setlocal enabledelayedexpansion

:restore
REM Buscar el archivo más reciente en la carpeta de respaldos
set last_backup=
for /f "delims=" %%F in ('dir /b /o-d C:\respaldo\learnx_backup_*.sql') do (
    set "last_backup=%%F"
    goto :found_backup
)

:found_backup
if "!last_backup!"=="" (
    echo No se encontraron archivos de respaldo en C:\respaldo\
    timeout /t 5 /nobreak >nul
    exit /B 1
)

echo Último archivo de respaldo encontrado: !last_backup!
echo Restaurando la base de datos...

REM Ejecutamos la restauración
C:\xampp\mysql\bin\mysql.exe -h localhost -u root learnx < C:\respaldo\!last_backup!

REM Capturamos el código de salida
set exitCode=!errorlevel!

if !exitCode! NEQ 0 (
    echo Error al restaurar el backup. Código de salida: !exitCode!
    exit /B !exitCode!
)

echo Restauración completada exitosamente desde !last_backup!
timeout /t 5 /nobreak >nul
exit /B 0