# Laravel + PrimeVue Starter Kit Rest api based

## 💡 Two ways to run this project

- Classic local setup (PHP + Node + WAMP)
- Docker-based setup (recommended)

## 🚀 1. System Requirements

- **PHP >= 8.5**
- **Composer >= 2.0**
- **Node.js >= 22 & npm**
- **MySQL / PostgreSQL / SQLite**
- **Git**
- **Docker**
- _(Optional)_ WAMP / XAMPP for local hosting

---

## 📦 2. Installation

### 2.1 Clone the repository

```bash
git clone https://github.com/vorenus85/laravel-vue-starter-rest-api
cd laravel-vue-starter-rest-api
```

### 2.2 Install PHP dependencies

```bash
composer install
```

### 2.3 Create the **.env** file

```bash
cp .env.example .env
```

Then update the .env file with the correct database and application settings.

### 2.4 Generate application key

```bash
php artisan key:generate
```

### 2.5 Run migrations and seed the database

```bash
php artisan migrate --seed
```

## 🎨 3. Frontend Setup

```bash
npm install
```

The project use Vite

```bash
npm run dev     # development mode (HMR)
npm run build   # production build
```

## 🔧 4. Start Local Development

In your composer.json includes a dev script:

```bash
composer dev
```

This command runs the following in parallel:

- php artisan serve
- php artisan queue:listen
- npm run dev

Alternatively, you can run them manually:

```bash
php artisan serve
php artisan queue:listen
npm run dev
```

## 🌐 5. Local Domain Configuration (optional)

To access the project via a custom local domain (e.g. laravel-vue-starter.local):

### Edit your hosts file

```lua
127.0.0.1    laravel-vue-starter.local
```

### Create an Apache VirtualHost

```apache
<VirtualHost *:80>
    ServerName laravel-vue-starter.local
    DocumentRoot "C:/wamp64/www/git/laravel-vue-starter/public"

    <Directory "C:/wamp64/www/git/laravel-vue-starter/public">
        AllowOverride All
        Require all granted
        Options Indexes FollowSymLinks
    </Directory>
</VirtualHost>
```

### Update .env

```env
APP_URL=http://localhost:8080
```

## 🐳 6. Running the project with Docker (recommended)

This project can also be run using **Docker + Docker Compose**, without installing PHP, Composer, Node.js or a web server locally.

### Prerequisites

- Docker Desktop (Windows / macOS / Linux)
- Docker Compose v2+

Verify installation:

```bash
docker --version
docker compose version
```

### Start the application

From the project root directory:

```bash
docker compose up -d
```

### Install dependencies

Backend (Laravel / PHP):

```bash
docker compose exec app composer install
```

Frontend (Vite / Node):

```bash
docker compose exec app npm install
```

### Environment file

```bash
cp .env.example .env
docker compose exec app php artisan key:generate
```

### Database migration & seeding

```bash
docker compose exec app php artisan migrate --seed
```

### Run Vite

```bash
docker compose exec app npm run dev
```

### Access the application

```bash
http://localhost:8080
```

(Port depends on docker-compose.yml configuration.)

### Stop containers

```bash
docker compose down
```

### Notes

- Docker replaces WAMP / XAMPP
- No local PHP, Composer or Node.js installation required
- Recommended for consistent team development

## 🧪 7. Run Tests

```bash
composer test
```

## 🧹 8. Useful Commands

| Command                            | Description                     |
| ---------------------------------- | ------------------------------- |
| `php artisan serve`                | Start Laravel dev server        |
| `php artisan migrate:fresh --seed` | Rebuild database with seed data |
| `php artisan cache:clear`          | Clear application cache         |
| `npm run dev`                      | Run frontend with HMR           |
| `npm run build`                    | Production frontend build       |
| `php artisan queue:listen`         | Start queue worker              |
