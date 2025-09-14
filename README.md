# Estates Egypt 

###  Requirements 
```
php 8.2 +
composer 2.8.9 + 
node 22 + 
npm 10.9.2 +
```
[Check Laravel Server Requirements]( https://laravel.com/docs/12.x/deployment )

### Configuration 

```bash
cd estate_egypt
composer install
npm install
cp .env.example .env
php artisan key:generate
```

laravel 12 by default using SQLite .
change it by open `.env` file , and change database section to any DBMS that laravel support  

```ini
DB_CONNECTION=<DBMS name>
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

for production , disable debug mode : 

```ini
APP_DEBUG=false
```

continue your configuration

```bash
php artisan migrate
php artisan db:seed  
php artisan storage:link
npm run build
```

run a local serverless 

```bash
php artisan serv
```
it will run at localhost:8000

using wildcard IP for runing globaly 

```bash
php artisan --host=0.0.0.0 --port=<Port Number>
```
