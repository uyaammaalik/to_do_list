# To Do List
To do list is a simple application to for making to do list and its still under development.

## Installation
### 1. Clone the repository
```
https://github.com/uyaammaalik/to_do_list.git
```

### 2. Create a MySQL database in database server
### 3. Copy and rename .env.example file to .env file
```
cd to_do_list
cp .env.example .env
```
In the .env file give database name in the database section. (created database name)

### 4. Generate application key
```
php artisan key:generate
```

### 5. Install necessary dependencies
```
composer install
```

### 6. Install ui dependencies
```
npm install
```

### 7. Run Migrations
```
php artisan migrate
```

### 8. Compile Assets
```
npm run dev
```

### 9. Run deployment server
```
php artisan serve
```
