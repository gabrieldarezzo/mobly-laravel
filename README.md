## Installation in Local

```bash
git clone URL `https://github.com/gabrieldarezzo/mobly-private.git` mobly
cd mobly
cp .env.example .env
```
Create a database:
```sql
CREATE DATABASE mobly COLLATE 'utf8_general_ci';
```
-> Set this base in your `.env`

```bash
composer install
php artisan key:generate
php artisan jwt:secret
php artisan config:clear
php artisan config:cache
php artisan serve
```


Seed tables:
```bash
php artisan migrate --seed
```

### With this command you'll LOSING whatever data is in the tables and recreate then:  
```bash
php artisan migrate:refresh --seed
```

## In Production server (1°/First Deploy)
```bash
git clone URL https://github.com/gabrieldarezzo/mobly-private.git mobly
cd mobly
composer install --no-dev --prefer-dist


### Symbolic lin for deploy:
In Laravel you dont need expose more than /public_html
```shell 
cd ~ && ln -s -f /home/storage/mobly/public /home/storage/public_html/mobly  
```    

## Updates:
Artisan server for develop app
```shell
php artisan serve --host 192.168.11 --port 8000
```
Ps: `192.168.11` === IPv4 ok?!



##  /Migration/Model/Seeder/Factory':
```shell
php artisan make:migration create_company_table --create=company --table=company
php artisan make:model Company
php artisan make:seeder CompanyTableSeeder
php artisan make:controller CompanyController
```

Ps: Don't forget add in `DatabaseSeeder.php` 
```php
$this->call(TemasTableSeeder::class);
```

Não esquece dentro de `routes/api.php`, adicionar o resource, para o CRUD ficar BALA.
```php
Route::resource('action', 'ActionController');
``` 

Ps: It's good run this if composer error after `git pull` :
```shell
composer dump-autoload
```

