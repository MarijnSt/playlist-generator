## About project

This project is a simple implementation of the spotify API to create playlists for when I go for a run.
It is a laravel project that uses Inertia and Vue3 to create the frontend.

## Requirements
You need to have a spotify account and create a new app in the spotify developer dashboard.
After that you can get the client id and client secret and set them in the .env file.
You can look at [this](https://developer.spotify.com/documentation/web-api/tutorials/getting-started) guide to create a new app.

## How to install
- cp .env.example .env
- add your client id and client secret to the .env file
- composer install
- php artisan key:generate
- php artisan migrate
- php artisan serve
- npm install
- npm run dev

## Resources
- [Laravel](https://laravel.com/docs/11.x)
- [Inertia](https://inertiajs.com/)
- [Vue](https://vuejs.org/guide/introduction.html)
- [Spotify API](https://developer.spotify.com/documentation/web-api/)
- [Laravel Actions](https://www.laravelactions.com/)

## TODO
- Implement refresh token flow
- Get all songs from the user's playlists
...
- Let the user select playlists to be used to generate the new playlist
- Let the user specify the length of the new playlist
- Generate a new playlist by randomly selecting songs from those playlists
- Let the user swap out songs they don't like
- Save the playlist to their spotify account
