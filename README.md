<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# VocabX API
Hello! You can use two different installation of VocabX API. One is manual and the other is with Docker. You can follow the links given below:
- [Manual Installation Guide](#installation-guide)
- [Installation Guide with Docker](#install--run-the-app-with-docker) 

## Installation Guide

### Prerequisites
- PHP 8.0+
- Composer
- MySQL/MariaDB
- JWT requirements installed (php-jwt dependency)

---

### 1. Install Dependencies
```bash
composer install
```

### 2. Environment Configuration
Copy environment file:
```bash
cp .env.example .env
```

Configure database settings using your preferred text editor:
```bash
# Using nano
nano .env

# Or using any other editor of your choice
```

Required configuration:
```env
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name  #vocabx_api for default
DB_USERNAME=your_mysql_username #root for default
DB_PASSWORD=your_mysql_password
```

### 3. Generate Application Keys
```bash
php artisan key:generate
php artisan jwt:secret
```

### 4. Database Setup
Create database (if not existing) & Run migrations:
```bash
php artisan migrate
```

**Note:** If the database doesn't exist, the migrate command will prompt you to create it.

### 5. Storage Configuration
```bash
php artisan storage:link
```

### 6. Database Seeding (Optional)
Seed all tables:
```bash
php artisan db:seed
```

Seed specific tables:
```bash
php artisan db:seed --class=UserSeeder
```

Reset and reseed database:
```bash
php artisan migrate:fresh --seed
```

### 7. Launch Development Server
```bash
php artisan serve
```

### 8. Default Login Credentials
email: test@kkaragoz.com  
password: password

---

## Additional Configuration

### Mail Setup (Optional - Not in use yet)
Configure mail settings in `.env` for email functionality:
```env
MAIL_MAILER=smtp
MAIL_HOST=mailpit
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
```
---

## Install & Run the app with Docker:
Docker deployment of VocabX API application. You can follow the steps and run the api with docker.

### Prerequisites
- Docker
- Docker Compose

### Clone the App
First of all, you should clone the application:
```bash
git clone https://github.com/kkrgzz/vocabx-api.git
```
After clone is done, you can enter the directory with:
```bash
cd vocabx-api
```

### Prepare the .env File 
For security reasons, you should prepare your `.env` file. But, you cannot see the `.env` file in the main directory when you just clone the app. So, you should copy the `.env.example` file as `.env` file and start to edit. Here is how to copy the file on a terminal (also you can just do the copy & past on your desktop environment GUI):
```bash
cp .env.example .env
```
And, done. Now start to edit the `.env` file. We don't have to change lots of things. We can just change the database related fields however we want.

```env
DB_DATABASE=vocabx_api_db
DB_USERNAME=vocabx_api_user
DB_PASSWORD=vocabx_api_user_password
MYSQL_ROOT_PASSWORD=vocabx_api_root_password
```

You can change the vocabx_api_db, vocabx_api_user, vocabx_api_user_password, vocabx_api_root_password fields as you wish. Here is an example:

```env
DB_DATABASE=vocabx_db
DB_USERNAME=vocabx_admin
DB_PASSWORD=Mikasa.Ackerman123
MYSQL_ROOT_PASSWORD=fI+Ovr!H4X05
```
Change the related fields as you wish.

If your `.env` file is ready-to-go, we can continue to setup the application. the next step is running the docker-compose file. 

---

### Run the Docker Compose
To run the docker-compose you can use the `Makefile` commands. Lets start with up the docker with the following command:

#### Up the Docker
If you want to use bare docker commands:
```bash
sudo docker-compose up -d --build
``` 

Or, if you want to use makefile commands:
```bash
sudo make up
```

#### Generate Key & JWT Token
If you want to use bare docker commands:
```bash
sudo docker exec <app_name> php artisan key:generate
``` 
and 
```bash
sudo docker exec <app_name> php artisan jwt:secret
``` 

Or, if you want to use makefile commands:
```bash
sudo make keygen
```

#### Run Migrations
If you want to use bare docker commands:
```bash
sudo docker exec <app_name> php artisan migrate
``` 

Or, if you want to use makefile commands:
```bash
sudo make migration
```

#### Set the Storage Link
If you want to use bare docker commands:
```bash
sudo docker exec <app_name> php artisan storage:link
``` 

Or, if you want to use makefile commands:
```bash
sudo make storage
```
#### Done!
The deployment is done. Now you can check the application on a web-browser with the following URL: http://localhost:8080

## Troubleshooting

### Common Issues
1. **Permission Errors**:
   ```bash
   chmod -R 775 storage/
   chmod -R 775 bootstrap/cache/
   ```

2. **Configuration Cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

3. **Database Connection Issues**:
   - Verify MySQL service is running
   - Double-check `.env` credentials
   - Ensure database user has proper privileges

---

## Production Deployment
For production environments:
- Set `APP_ENV=production` in `.env`
- Disable debug mode: `APP_DEBUG=false`
- Configure proper webserver (Nginx/Apache)
- Set up process manager for queue workers
