# Kings Newsletter

## how to install and run

1. Fork or Clone the repo
2. Setup the database
3. create .env from .env.example (cp .env.example .env)
4. Add the database info
5. run the migration (php artisan migrate)
6. Add your email address and the password in the .env
7. Change the queue connection to redis (QUEUE_CONNECTION=redis)
8. Run the app (php artisan migrate)