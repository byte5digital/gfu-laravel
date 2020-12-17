# GFU Training

## Requirements

* [Laravel 6](https://laravel.com/docs/6.x)
* [Composer](https://getcomposer.org/)

### For Docker Setup

* [Docker Desktop](https://hub.docker.com/editions/community/docker-ce-desktop-windows)
* [WSL2 for Windows10](https://docs.microsoft.com/de-de/windows/wsl/install-win10)

### Local Installation see below

## Getting Started

Clone the master branch in your working directory using:
```
git clone https://github.com/byte5digital/gfu-laravel
```
You will find the project afterwards in the folder `gfu-laravel`.

Optional you can also download the .zip and unpack it in a directory you'll call `gfu-laravel`.


## Scripts

-   start.sh => Starts Docker Setup inkl. MariaDB Database
-   update.sh => Migrates Databases, sets APP Key and clears cache 
-   shell.sh => Opens Shell on Webserver (Docker)

## Add Auth Facades

-   composer require laravel/ui "^1.0" --dev
-   php artisan ui vue --auth

## Add Helper classes (barryvdh/laravel-ide-helper)

- helper.sh => Creates Class helpers as well as Model Helper Classes


## Adding Sample Data to Database

After the migration is complete, you can seed the tables with sample data if needed.

The sample data contains:
- 1 Category
- 15 Default Users
- 15 Articles (one for each User)
- 1 Admin User

To seed the database please run:
```
php artisan db:seed
```

### Logging in with Sample Admin

The following data can be used to login with the sample admin user to view the example admin panel:

E-Mail | Password
------------ | -------------
admin@example.com | password

## Local Installation

To install the application open your commandline and navigate to the project folder `gfu-laravel`.

Run the following command in your project directory:

```
composer install
```
Please note that [Composer](https://getcomposer.org/) is required to perform this action.


### Database Setup 
To set up your database connection rename the `.env.example` to `.env`.

Open `.env` and change the default database connection to **your** database connection:

```
DB_CONNECTION= **YOUR_CONNECTION_TYPE**
DB_HOST= **YOUR_HOST_IP**
DB_PORT= **YOUR_DB_PORT**
DB_DATABASE= **YOUR_DB_NAME**
DB_USERNAME= **YOUR_DB_USERNAME**
DB_PASSWORD= **YOUR_DB_PASSWORD**
```

#### Create neccessary tables

To create the tables needed for this project you can simply run:

```
php artisan migrate
```

### Redis Setup

Open `.env` and change the default redis connection to **your** redis connection:

```
REDIS_HOST=**YOUR_HOST**
REDIS_PASSWORD=**YOUR_PASSWORD**
REDIS_PORT=**YOUR_PORT**
```

also set the following in `.env`:

```
LOG_CHANNEL=stack

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### Start Built-in Webserver

To start the built in webserver use command:

```
php artisan serve
```

## Link Storage

In case uploaded pictures aren't showing up use the following command to link the storage:

```
php artisan storage:link
```