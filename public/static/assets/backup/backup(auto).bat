@echo off
setlocal enabledelayedexpansion

:backup
REM Obtener la fecha y hora actual en formato deseado (incluyendo el año)
for /f %%x in ('powershell Get-Date -Format "dd_MM_yyyy_HH_mm"') do set "timestamp=%%x"

REM Creamos el nombre del archivo con la fecha y hora
set file_name=learnx_backup_!timestamp!.sql

REM Ejecutamos el respaldo con el nombre de archivo calculado
echo Creando archivo...
C:\xampp\mysql\bin\mysqldump.exe -h localhost -u root learnx > C:\respaldo\!file_name!

echo Backup realizado !file_name!

timeout /t 5 /nobreak >nul
goto backup
