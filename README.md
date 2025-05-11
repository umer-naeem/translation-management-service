# Translation Management API

A Laravel-based API service for managing translations for multiple locales. This service allows users to create, update, view, and search translations. It also includes a JSON export endpoint for frontend applications.

## Table of Contents
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [API Endpoints](#api-endpoints)
    - [Authentication](#authentication)
    - [Translations](#translations)
    - [Export](#export)
- [Running the Application](#running-the-application)
- [Testing](#testing)
- [Notes](#notes)
- [License](#license)

## Requirements
- PHP 8.1 or higher
- Laravel 12
- MySQL
- Composer

## Installation

### 1. Clone the Repository
Clone this repository to your local machine using the following command:

```bash
git clone https://github.com/your-username/translation-management-api.git

cd translation-management-api
composer install

php artisan key:generate

php artisan migrate

php artisan db:seed

php artisan seed:large-translations
```


---

### Explanation:

### Dummy User Authentication

To quickly test the authentication, you can use the following dummy user credentials:

- **Email**: `umernaeem125@gmail.com`
- **Password**: `password`


### Authentication Endpoint

You can authenticate by sending a `POST` request to the `login` endpoint with the email and password. This will return an authentication token.

#### Request

```http
POST /api/login
Content-Type: application/json
```

### Create a Token

After running the `php artisan db:seed` command to populate the database with the dummy user

2. **Translations**:
    - `POST /api/translations`: Create a new translation.
    - `PUT /api/translations/{id}`: Update an existing translation.
    - `GET /api/translations`: Fetch all translations.
    - `/api/translations?key=welcome&locale=en&tags=web`: Search translations based on key and locale.

3. **Export**:
    - `GET /api/translations-export`: Exports translations in a format suitable for frontend applications (like Vue.js).

4. **Error Handling**:
    - The API includes error handling for missing or invalid translations.

---


Running the Application Start the development server:
````
php artisan serve
