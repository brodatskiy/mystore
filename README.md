# Installation
```
docker compose up -d
docker exec app composer install
docker exec app npm install
docker exec app php artisan migrate
docker exec app php artisan key:generate
docker exec app php artisan app:install #создать admin-user, storage link
docker exec app chmod -R 775 ./storage
docker exec app chmod -R 775 ./bootstrap/cache

docker exec app php artisan db:seed #создать фейковые записи в таблицах

```
# Login

email: admin@admin.com

password: password
