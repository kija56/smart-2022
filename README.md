
# `Test` APP

# Setup

## Clone this project to your local environment

- database

  ```sh
  Database type: mysql;
  $ create a database
  
- Copy configuration

  ```sh
  composer install
  $ cp .env.example .env
  $ php artisan key:generate
  ```

- Setup database to the .env file

  ```sh
  DB_DATABASE=YOUR_DB_NAME
  DB_USERNAME=YOUR_USER_NAME
  DB_PASSWORD=YOUR_DB_PASSWORD

- Run Migration

  `php artisan migrate`
  
- Install Node & Npm

     `npm install && npm run dev`

- Start application
  - clear cache

  ```
     php artisan optimize:clear
  
     php artisan serve
  ```
