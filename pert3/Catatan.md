- ➜  coding git:(main) ✗ docker ps
- ➜  coding git:(main) ✗ docker exec -it pemweb bash
- root@pemweb:/var/www/html# composer create-project --prefer-dist raugadh/fila-starter .

- root@pemweb:/var/www/html# rm -rf *.
- root@pemweb:/var/www/html# composer create-project --prefer-dist raugadh/fila-starter .

- root@pemweb:/var/www/html# rm -rf *.
- root@pemweb:/var/www/html# ls

# src di .env
    APP_NAME="Pemweb"
    APP_ENV=local
    APP_KEY=base64:q0VW6bPDldkF8YzSZn4rv6RciulqRIck4NAX+ENcfXM=
    APP_DEBUG=true
    APP_TIMEZONE='Asia/Jakarta'
    APP_URL=http://localhost
    ASSET_URL=http://localhost
    DEBUGBAR_ENABLED=false
    ASSET_PREFIX=
    #ASSET_PREFIX=/dev/kit/public example incase deployed inside a folder

    DB_CONNECTION=mysql
    DB_HOST=db_pemweb
    DB_PORT=3306
    DB_DATABASE=db_pemweb
    DB_USERNAME=root
    DB_PASSWORD=p455w0rd

# balik terminal
- root@pemweb:/var/www/html# chown -R www-data:www-data storage/*
- root@pemweb:/var/www/html# php artisan storage:link

- root@pemweb:/var/www/html# php artisan migrate
- root@pemweb:/var/www/html# php artisan migrate:fresh

- root@pemweb:/var/www/html# php artisan db:seed --force
- Lalu error minta guard, ketik php artisan shield:generate --all
- root@pemweb:/var/www/html# php artisan project:init
- root@pemweb:/var/www/html# chmod 777 -R storage/* && chmod 777 -R bootstrap/*

# Buka localhost di chrome
- localhost/admin/login
clear? Logout.

# Balik lg vscode
- template - copy folder css, images, js, plugins
- src - public - front ->> paste yang tadi
- src - resources - views - create folder component --> app.blade.php 
- template --> index.html --> paste app.blade.php
- sisain header dan footer disitu yg kode index.html
- Bagian header
'''
        <head>
        <meta charset="utf-8">
        <title>{{ $title ?? 'Pemweb' }} </title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
        <meta name="description" content="This is meta description">
        <meta name="author" content="Themefisher">
        <link rel="shortcut icon" href={{ assett ('front/images/favicon.png') }}" type="image/x-icon">
        <link rel="icon" href={{ assett ('front/images/favicon.png') }}" type="image/x-icon">

        <!-- # Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

        <!-- # CSS Plugins -->
        <link rel="stylesheet" href={{ assett ('front/plugins/slick/slick.css') }}">
        <link rel="stylesheet" href={{ assett ('front/plugins/font-awesome/fontawesome.min.css') }}">
        <link rel="stylesheet" href={{ assett ('front/plugins/font-awesome/brands.css') }}">
        <link rel="stylesheet" href={{ assett ('front/plugins/font-awesome/solid.css') }}">

        <!-- # Main Style Sheet -->
        <link rel="stylesheet" href="css/style.css') }}">
    </head>
'''