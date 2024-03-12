# interview-laravel

## Assignment Answer - By Lee Szeyu

### Setup Local Environment

1. After clone the repository, set up a multi-container applications

```bash
cp .env.example .env
docker compose up -d
```

2. Access the toyeight.app (Docker container) by

```bash
docker exec -it <container_id> sh
# OR docker exec -it <container_id> /bin/bash
```

- In order to obtain the container ID, can use following command

```bash
docker ps

# sample output of docker ps
CONTAINER ID   IMAGE                    COMMAND                  CREATED       STATUS                 PORTS                                     NAMES
59d05ac8a7cf   laravel/php-apache       "docker-php-entrypoi…"   4 hours ago   Up 4 hours             0.0.0.0:8080->80/tcp                      toyeight.app
5533f13fbea2   mysql/mysql-server:8.0   "/entrypoint.sh mysq…"   4 hours ago   Up 4 hours (healthy)   33060-33061/tcp, 0.0.0.0:3316->3306/tcp   toyeight.db
```

3. In the toyeight.app command line interface (cli), we can set up our laravel project

```bash
cp .env.example .env
composer install
php artisan key:generate
```

4. Next is to run database migration

```bash
# remove the --seed if only need to migrate database schema
php artisan migrate:fresh --seed
```

5. Now, we can test our application

```bash
# feature test with phpunit
# equivalent to vendor/bin/phpunit --testdox
composer test

# static analysis with Larastan
# equivalent to vendor/bin/phpstan analyse --memory-limit=2G
composer analyse
```

### Extra

1. We can use Laravel default PHP code style fixer by

```bash
# equivalent to vendor/bin/pint
composer beautify
```

2. Every commit to this repository will trigger GitHub Action automatically. The details steps and setup can refer `./.github/workflow/laravel.yml`. Basically it just run all of the steps we mention at [Setup Local Environment](#setup-local-environment).

3. There is a folder `/src/postman`. Inside there has two file, collection.json and environment.json. User can import it directly in Postman API platform to use APIs specified in `./routes/api.php`.

Now testing codepipeline