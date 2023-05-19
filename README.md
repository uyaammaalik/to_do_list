Git Reposotory name
    https://github.com/uyaammaalik/to_do_list
    
Clone Repository
    git clone https://github.com/uyaammaalik/to_do_list.git
    
Install dependencies
    cd to_do_list
    composer install
    
Database name **to_do_list**  //any name

Configure environment 
    cp .env.example .env
    php artisan key:generate

Run migrations
    php artisan migrate
    
Install ui dependencies
    npm install
    
Run project
    npm run dev
    php artisan serve
