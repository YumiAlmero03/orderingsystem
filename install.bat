echo %0
echo "setup env first"
pause
composer install
npm install
php artisan 
php artisan migrate --seed
