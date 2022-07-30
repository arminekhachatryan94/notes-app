# Notes-app
A basic notes app using Laravel, React (TypeScript), MySQL, and Docker

## Backend
Go to the backend folder:
`cd backend`

Install dependencies:
`composer install`

Copy the `.env.example` file and name it `.env`. Then, add a database connection to it by providing a value for the `DB_` values.

Generate a key:
`php artisan key:generate`

Run the migrations and seeders:
`php artisan migrate:fresh --seed`

To run the project:
`vendor/bin/sail up`

To go into the container:
`vendor/bin/sail bash`

Run unit tests in the container:
`vendor/bin/phpunit tests/Unit`

Run tests in the container and generate code coverage report:
(The reports will be saved in the `backend/coverage/reports folder`)
`vendor/bin/phpunit --coverage-html coverage/reports`

To view the coverage report:
Open the `backend/coverage/reports/index.html` file in the browser.
![alt text](/CodeCoverageReport.png)

## Frontend
Go to the frontend folder:
`cd frontend`

Install dependencies:
`npm install`

To run the project:
`npm start`
