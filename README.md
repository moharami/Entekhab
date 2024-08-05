# User Management API For Entekhab Service

## Overview

This API provides functionalities for user registration, login, and updating user details. It is built using Laravel and employs Sanctum for API authentication.

## Features

- **User Registration**: Allows users to create a new account.
- **User Login**: Authenticates users and issues an API token.
- **Update User Details**: Allows authenticated users to update their details and address information.

## Installation

To get started with this project, follow these steps:

1. **Clone the Repository**

    ```bash
    git clone https://github.com/moharami/Entekhab.git
    cd Entekhab
    ```

2. **Install Dependencies**

   Ensure you have [Composer](https://getcomposer.org/) installed, then run:

    ```bash
    composer install
    ```

3. **Set Up Environment**

   Copy the `.env.example` file to `.env` and set up your environment variables. You might need to configure your database settings and other environment-specific parameters.

    ```bash
    cp .env.example .env
    ```

4. **Generate Application Key**

    ```bash
    php artisan key:generate
    ```

5. **Run Migrations**

    ```bash
    php artisan migrate
    ```

6. **Start the Server**

    ```bash
    php artisan serve
    ```

## API Endpoints

### 1. User Registration

- **Endpoint**: `POST /api/register`
- **Request Body**:
    ```json
    {
        "name": "Amir Moharami",
        "mobile": "1234567890",
        "email": "a.moharami@example.com",
        "password": "password123"
    }
    ```
- **Response**:
    ```json
    {
        "message": "User registered successfully"
    }
    ```

### 2. User Login

- **Endpoint**: `POST /api/login`
- **Request Body**:
    ```json
    {
        "mobile": "1234567890",
        "password": "password123"
    }
    ```
- **Response**:
    ```json
    {
        "success": true,
        "access_token": "your-access-token",
        "token_type": "Bearer",
        "user": {
            "id": 1,
            "name": "Amir Moharami",
            "mobile": "1234567890",
            "email": "a.moharami@example.com"
        }
    }
    ```

### 3. Update User Details

- **Endpoint**: `POST /api/user-details`
- **Request Body**:
    ```json
    {
        "national_id": "1234567890",
        "street": "Emam",
        "city": "Isfahan",
        "state": "Isfahan",
        "postal_code": "12345",
        "country": "Country"
    }
    ```
- **Authentication**: Bearer token required
- **Response**:
    ```json
    {
        "message": "User details updated successfully",
        "userDetail": {
            "user_id": 1,
            "national_id": "1234567890"
        },
        "address": {
            "user_id": 1,
            "street": "Emam",
            "city": "Isfahan",
            "state": "Isfahan",
            "postal_code": "12345",
            "country": "Country"
        }
    }
    ```

## Testing

To run the tests for this project, use:

```bash
php artisan test
