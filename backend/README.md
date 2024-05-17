cp .env.example .env

docker compose up -d

docker exec jukebox_api composer install

docker exec jukebox_api php artisan key:generate

docker exec jukebox_api php artisan migrate

docker exec jukebox_api php artisan test
