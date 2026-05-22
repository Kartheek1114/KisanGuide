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

rem Run Laravel development server
php artisan serve
