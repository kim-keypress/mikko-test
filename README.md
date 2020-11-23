# Mikko Test
## Setup
1. Setup a mysql database
1. Copy the `.env.example` file to a file named `.env` in the root of the project,
for production environments set the `APP_DEBUG` variable to false and change the
`APP_ENV` variable to `production`
1. Run the `php artisan key:generate` command to generate an application key
1. Serve the project with PHP's built in development server with the 
`php artisan serve` command
