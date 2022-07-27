# notes-app
A basic notes app using Laravel, React (TypeScript), MySQL, and Docker

## backend
Go to the backend folder:
`cd backend`

Install dependencies:
`composer install`

Copy the `.env.example` file and name it `.env`. Then, add a database connection to it by providing a value for the `DB_` values. I used a local db.

Generate a key:
`php artisan key:generate`

Run the migrations and seeders:
`php artisan migrate:fresh --seed`

To run the project:
`php artisan serve`

## frontend
Go to the frontend folder:
`cd frontend`

Install dependencies:
`npm install`

To run the project:
`npm start`

