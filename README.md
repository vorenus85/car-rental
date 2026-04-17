# Car Rental

A modern full-stack car rental application built with Laravel and Vue.js, featuring booking management, car inventory handling, and a scalable architecture with Docker-based development environment. Designed to simulate real-world rental workflows with clean UI and developer-friendly setup.

## 🚀 1. System Requirements

### ✅ Recommended (Docker-based setup)

- Docker Desktop
- Docker Compose v2+

👉 No need to install PHP, Composer, Node.js or MySQL locally.

### ⚙️ Alternative (manual setup)

- PHP >= 8.4
- Composer >= 2.0
- Node.js >= 22 & npm
- MySQL / PostgreSQL / SQLite
- Git

---

## 📦 2. Installation

### 2.1 Clone the repository

```bash
git clone https://github.com/vorenus85/car-renter
cd car-renter
```

---

## 🐳 3. Running with Docker (Recommended)

### 3.1 Start containers

```bash
docker compose up -d
```

### 3.2 Install dependencies

```bash
docker compose exec app composer install
docker compose exec app npm install
```

### 3.3 Environment setup

```bash
cp .env.example .env
docker compose exec app php artisan key:generate
```

### 3.4 Database setup

```bash
docker compose exec app php artisan migrate --seed
```

### 3.5 Start frontend (Vite)

```bash
docker compose exec app npm run dev
```

### 3.6 Access application

```bash
http://localhost:8080
```

(Port depends on docker-compose.yml)

### 3.7 Stop containers

```bash
docker compose down
```

---

## ⚙️ 4. Manual Development (without Docker)

Use this only if you don’t want Docker.

### 4.1 Install dependencies

```bash
composer install
npm install
```

### 4.2 Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4.3 Database

```bash
php artisan migrate --seed
```

### 4.4 Run development environment

```bash
composer dev
```

This runs:

- php artisan serve
- php artisan queue:listen
- npm run dev

---

## 🧪 5. Run Tests

### Docker

```bash
docker compose exec app php artisan test
```

### Manual

```bash
composer test
```

---

## 🧹 6. Useful Commands

### 🐳 Docker

| Command                                                    | Description                        |
| ---------------------------------------------------------- | ---------------------------------- |
| `docker compose up -d`                                     | Start all containers               |
| `docker compose down`                                      | Stop all containers                |
| `docker compose down -v`                                   | Stop containers and remove volumes |
| `docker compose build --no-cache`                          | Rebuild containers from scratch    |
| `docker compose exec app bash`                             | Open shell inside app container    |
| `docker compose exec app php artisan migrate`              | Run database migrations            |
| `docker compose exec app php artisan migrate:fresh --seed` | Reset DB with seed data            |
| `docker compose exec app php artisan cache:clear`          | Clear application cache            |
| `docker compose exec app php artisan queue:listen`         | Start queue worker                 |

### 🧪 Backend Testing

```bash
docker compose exec app php artisan test --coverage
```

HTML report:

```bash
coverage/index.html
```

### 🧪 Frontend Testing (Vue + Vitest)

| Command                 | Description                    |
| ----------------------- | ------------------------------ |
| `npm run test`          | Run tests in watch mode        |
| `npm run test:run`      | Run tests once                 |
| `npm run test:coverage` | Run tests with coverage report |
