## About project

This project is a simple implementation of the spotify API to create playlists for when I go for a run.

## Tech used

- Laravel: authentication, spotify API, laravel actions and data objects
- Inertia: connects Vue and Laravel
- Vue: frontend with Primevue UI components
- Vite: frontend build tool
- Pinia: state management

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

## Transforming laravel Data to Typescript for front
When you add new data objects in the backend, you need to run this command:
```
php artisan typescript:transform
```
This will create or update the resources/js/types/generated.ts file which you can use to import the types in the front.

## Resources
- [Laravel](https://laravel.com/docs/11.x)
- [Inertia](https://inertiajs.com/)
- [Vue](https://vuejs.org/guide/introduction.html)
- [Spotify API](https://developer.spotify.com/documentation/web-api/)
- [Laravel Actions](https://www.laravelactions.com/)
- [Laravel Data](https://spatie.be/docs/laravel-data/v4/introduction)
- [Primevue](https://primevue.org/introduction/)
- [Pinia](https://pinia.vuejs.org/introduction.html)

## TODO
- Show the user's playlists on the front
- Get all songs from the user's playlists
...
- Let the user select playlists to be used to generate the new playlist
- Let the user specify the length of the new playlist
- Generate a new playlist by randomly selecting songs from those playlists
- Let the user swap out songs they don't like
- Save the playlist to their spotify account
- Check refresh token flow
