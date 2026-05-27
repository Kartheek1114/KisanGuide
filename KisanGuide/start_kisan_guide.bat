@echo off

rem Navigate to project directory
cd /d "%~dp0"

rem Install PHP dependencies if needed
if not exist vendor (
    echo Installing Composer dependencies... 
    composer install
)

@echo off

rem Navigate to project directory
cd /d "%~dp0"

rem Install PHP dependencies if needed
if not exist vendor (
    echo Installing Composer dependencies... 
    composer install
)

rem Install npm dependencies if needed
if not exist node_modules (
    echo Installing npm packages... 
    npm install
)

rem Run Vite dev server in background
start "Vite" cmd /c "npm run dev"

rem Wait until Vite is listening on port 5173
:check_vite
powershell -Command "if ((Get-NetTCPConnection -LocalPort 5173 -State Listen).Count -eq 0) { exit 1 } else { exit 0 }"
if errorlevel 1 (
    timeout /t 1 >nul
    goto check_vite
)

rem Open Vite URL in default browser
start "" "http://localhost:5173"

rem Run Laravel development server
php artisan serve

rem Wait until Laravel is listening on port 8000
:check_laravel
powershell -Command "if ((Get-NetTCPConnection -LocalPort 8000 -State Listen).Count -eq 0) { exit 1 } else { exit 0 }"
if errorlevel 1 (
    timeout /t 1 >nul
    goto check_laravel
)

rem Open Laravel app URL in default browser
start "" "http://127.0.0.1:8000"
