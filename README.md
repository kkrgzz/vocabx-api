<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# VocabX API

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
Create database (if not existing):
```bash
php artisan db:create  # If using Laravel 8+
```

Run migrations:
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
php artisan db:seed --class=LanguageSeeder
```

Reset and reseed database:
```bash
php artisan migrate:fresh --seed
```

### 7. Launch Development Server
```bash
php artisan serve
```

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