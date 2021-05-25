# Setup Guide

## Step 1. Setup Environment
Prepare the following environment
* PHP >= 7.1
* MariaDB > 10.4.19

Install dependencies via Composer
```
composer install
```

## Step 2. Update Environment Variables
Copy the .env file from template
```
cp .env.example .env
```

Update the following variables
* FREE_API_KEY=`"c93c85d0e6059bcb08af"`
* DB_HOST=`{Your own value}`
* DB_PORT=`{Your own value}`
* DB_DATABASE=`{Your own value}`
* DB_USERNAME=`{Your own value}`
* DB_PASSWORD=`{Your own value}`

## Step 3. Run Database Migrations
```
php artisan migrate
```

## Step 4. Run Local Development Server
```
php artisan serve
```

Visit `localhost:8000`

# Data Structure
Tables: `daily_rates`

## DailyRate
* id: int
* rate: double
* date: string
* created_at: timestamp
* updated_at: timestamp
