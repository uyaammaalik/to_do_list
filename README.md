# To-Do List

This is a simple to-do list application built with Laravel.

## Installation

### Clone Repository

```shell
git clone https://github.com/uyaammaalik/to_do_list.git
```
### Install dependencies
```shell 
cd to_do_list
composer install
```
    
### Database name: **to_do_list**  <!-- any name -->

### Configure environment 
```shell
cp .env.example .env
php artisan key:generate
```

### Run migrations
```shell
php artisan migrate
```

### Install ui dependencies
```shell
npm install
```

### Run project
```shell
npm run dev
php artisan serve
```
