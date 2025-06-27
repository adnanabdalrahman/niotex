# Laravel API

## Introduction

This is a Laravel-based API that provides endpoints for managing resources efficiently. It follows RESTful principles
and supports authentication, validation, and error handling.

## Requirements

- PHP 8.0+
- Laravel 10+
- MySQL / PostgreSQL
- Composer
- Node.js & NPM (for frontend dependencies if applicable)

## Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/your-repo.git
   cd your-repo
   ```

2. Install dependencies:
   ```sh
   composer install
   ```

3. Create and configure the `.env` file:
   ```sh
   cp .env.example .env
   ```
   Update database credentials and other environment settings.

4. Generate the application key:
   ```sh
   php artisan key:generate
   ```

5. Run migrations and seeders:
   ```sh
   php artisan migrate --seed
   ```

6. Start the development server:
   ```sh
   php artisan serve
   ```

## Authentication

This API uses Laravel Sanctum for authentication. To obtain a token, make a POST request to:

```sh
POST /api/login
```

with the following JSON payload:

```json
{
    "email": "user@example.com",
    "password": "password"
}
```

The response will contain an authentication token to be used in subsequent requests:

```json
{
    "token": "your-access-token"
}
```

Include this token in the `Authorization` header:

```sh
Authorization: Bearer your-access-token
```

## API Endpoints

### User Routes

| Method | Endpoint      | Description            |
|--------|---------------|------------------------|
| POST   | /api/login    | Login and get token    |
| POST   | /api/register | Register a new user    |
| POST   | /api/logout   | Logout the user        |
| GET    | /api/user     | Get authenticated user |

### Example Resource Routes

| Method | Endpoint            | Description           |
|--------|---------------------|-----------------------|
| GET    | /api/resources      | Get all resources     |
| GET    | /api/resources/{id} | Get a single resource |
| POST   | /api/resources      | Create a new resource |
| PUT    | /api/resources/{id} | Update a resource     |
| DELETE | /api/resources/{id} | Delete a resource     |

## Testing

Run tests using PHPUnit:

```sh
php artisan test
```

## Deployment

1. Set up the production environment.
2. Run `composer install --no-dev --optimize-autoloader`.
3. Run migrations: `php artisan migrate --force`.
4. Configure queue workers, cron jobs, and caching.
5. Restart the server: `php artisan config:clear && php artisan cache:clear`.

## License

This project is licensed under the MIT License.

app/
├── Http/
│ ├── Controllers/
│ │ ├── MMController.php             <-- Handles Material Management (MM) requests
│ │ ├── SDController.php             <-- Handles Sales & Distribution (SD) requests
│ │ ├── SEController.php             <-- Handles SE module requests
│ │ ├── NKController.php             <-- Handles NK module requests
│ ├── Requests/                        <-- Validation Requests (optional, for reusable validation rules)
│ │ ├── MMRequests.php               <-- Validation rules for MM requests
│ │ ├── SDRequests.php               <-- Validation rules for SD requests
│ ├── Events/                          <-- Events for triggering logic after SAP requests are processed
│ │ ├── MaterialDataReceived.php     <-- Event for MM data processing
│ │ ├── OrderConfirmationReceived.php <-- Event for SD data processing
│ ├── Providers/                       <-- Service Providers for any services or configurations
│ │ ├── SAPServiceProvider.php      <-- SAP service provider (e.g., SAP authentication, SAP connection handling)
│ ├── Middleware/                      <-- Middleware for any pre or post processing logic (if required)
│ │ ├── SAPAuthentication.php       <-- Middleware for SAP Authentication (e.g., validating request headers)
├── Models/
│ ├── Material.php                     <-- Model for Material data (MM)
│ ├── Order.php                        <-- Model for Sales Orders (SD)
├── Services/
│ ├── SAPConnection.php               <-- Logic for SAP connection handling (e.g., API client, authentication)
│ ├── SAPResponseHandler.php          <-- Logic for handling and parsing SAP responses
├── OpenAPI/                             <-- OpenAPI specifications, docs, and generated files
│ ├── api-spec.yaml                   <-- OpenAPI specification file (YAML format)
│ ├── swagger.json                    <-- Generated Swagger JSON (optional, generated via OpenAPI tools)
│ ├── docs/                            <-- Generated or manually written documentation files
├── routes/
│ ├── api.php                          <-- API routes for MM, SD, etc.
│ └── web.php                          <-- Optional web routes for any other services

## changees

25.04.2025
change Route

- mm/311/materialstammdaten -> mm/3101/materialstammdaten
- mm/221/lagerbestaende -> mm/2201/lagerbestaende

## New Feature

1 - sd/0101/beauftragung

php artisan ide-helper:models --write
