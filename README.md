# Car Rental

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
git clone https://github.com/vorenus85/car-renter
cd car-renter
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

On first start the `app` container now installs missing PHP dependencies automatically if `vendor/` is not present yet.

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

### 🐳 Docker Commands

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

### 🧪 Testing & Coverage

### Backend (Laravel)

| Command                                                             | Description                             |
| ------------------------------------------------------------------- | --------------------------------------- |
| `docker compose exec app php artisan test`                          | Run backend tests                       |
| `docker compose exec app php artisan test --coverage`               | Run backend tests with coverage summary |
| `docker compose exec app php artisan test --coverage-html=coverage` | Generate backend HTML coverage report   |

Coverage report will be available at:

```bash
coverage/index.html
```

### Frontend (Vue + Vitest)

| Command                 | Description                    |
| ----------------------- | ------------------------------ |
| `npm run test`          | Run tests in watch mode        |
| `npm run test:run`      | Run tests once                 |
| `npm run test:coverage` | Run tests with coverage report |

Frontend coverage report will be generated in:

```bash
coverage/
```
