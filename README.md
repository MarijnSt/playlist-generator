## About project
When I go for a run, I like to listen to music or podcasts that I saved on my watch. 
The problem is that most of my playlists are really long so downloading it would take ages and would take up a lot of space on my watch.
That's why I wanted to write a simple app that lets me generate a playlist of a certain length that consists of random songs picked from all of my playlists (or at least the ones I selected).

*This is a work in progress and I'm adding new features whenever I have some free time to work on the project. It also serves as a demo project for me to showcase some of my skills.*

You can have a look at a live version of the project [here](http://128.199.33.85/).

### Tech used
- Laravel: authentication, spotify API, laravel actions and data objects
- Inertia: connects Vue and Laravel
- Vue: frontend with Primevue UI components
- Vite: frontend build tool
- Pinia: state management

### Requirements
If you want to run this locally, you need to have a Spotify account and create a new app in the Spotify developer dashboard.
After that you can get the client id and client secret and set them in the .env file.
You can look at [this](https://developer.spotify.com/documentation/web-api/tutorials/getting-started) guide for more info on how to create a new app.

### How to install
- cp .env.example .env
- add your client id and client secret to the .env file
- composer install
- php artisan key:generate
- php artisan migrate
- php artisan serve
- npm install
- npm run dev

### Transforming laravel Data to Typescript for front
When you add new data objects in the backend, you need to run this command:
```
php artisan typescript:transform
```
This will create or update the resources/js/types/generated.ts file which you can use to import the types in the front.

### Resources
- [Laravel](https://laravel.com/docs/11.x)
- [Inertia](https://inertiajs.com/)
- [Vue](https://vuejs.org/guide/introduction.html)
- [Spotify API](https://developer.spotify.com/documentation/web-api/)
- [Laravel Actions](https://www.laravelactions.com/)
- [Laravel Data](https://spatie.be/docs/laravel-data/v4/introduction)
- [Primevue](https://primevue.org/introduction/)
- [Pinia](https://pinia.vuejs.org/introduction.html)
