## About project

This project is a simple implementation of the spotify API to create playlists for when I go for a run.
It is a laravel project that uses Inertia and Vue3 to create the frontend.

## Requirements
You need to have a spotify account and create a new app in the spotify developer dashboard.
After that you can get the client id and client secret and set them in the .env file.
You can look at [this](https://developer.spotify.com/documentation/web-api/tutorials/getting-started) guide to create a new app.

## How to install
- cp .env.example .env
- composer install
- php artisan key:generate
- php artisan migrate
- php artisan serve
- npm install
- npm run dev

## TODO
...
