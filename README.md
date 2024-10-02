
# Cloning Laravel Project from GitHub

Follow these steps to clone and set up a Laravel project from this repository:

## 1. Clone the repository:

```bash
git clone <GitHub Repository URL>
```

## 2. Navigate to the cloned repository:

Use your Command Prompt (CMD) or Terminal to navigate to the project folder:

```bash
cd <Cloned project name>
```

## 3. Install project dependencies using Composer:

```bash
composer install

```

If you encounter any errors due to obsolete or deprecated packages, run this command:

```bash
composer update
```

## 4. Copy the example environment file:

```bash
cp .env.example .env
```

If you encounter an error with the `cp` command, use this instead:

```bash
copy .env.example .env
```

## 5. Generate an application key:

```bash
php artisan key:generate
```

## 6. Open the `.env` file and configure the database:

Create the database name (`DB_DATABASE`), username (`DB_USERNAME`), and password (`DB_PASSWORD`) to match your database configuration:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blogsystem
DB_USERNAME=root
DB_PASSWORD=
```



## 7. Run the database migrations:

```bash
php artisan migrate
```

```bash
php artisan migrate --seed
```




## 8. Start the development server:

```bash
php artisan serve
```

The default port is `8000`. If the port is already in use, you can specify a different port like this:

```bash
php artisan serve --port=8080
```

## 9. Access the Laravel application:

Open your web browser and navigate to:

```
http://localhost:8000
```

to access your Laravel application.
