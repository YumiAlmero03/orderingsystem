echo "updating..."
git pull
composer install
npm install
php artisan migrate --seed
