@echo off

:: Navigate to project directory
cd /d "c:\Users\karth\OneDrive\Desktop\LaravelProject\KisanGuide"

:: Start Laravel development server
start "Laravel Server" php artisan serve

:: Start Vite asset compilation
start "Vite Dev" npm run dev

:: End of script
