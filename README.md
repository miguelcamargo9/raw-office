# The Raw Office API

## Introduction

The Raw Office API is a RESTfull API that provides information about users.

## Specifications

- PHP 8.1
- Laravel 10.10
- MySQL 8.0

## Installation

### Requirements

- Docker compose

### Steps

1. Clone this repository
2. Run `docker compose up -d`
3. You can access the API in `http://localhost:8080`

## Testing

You can run the tests inside the container with the following command:

```
 docker exec -it the-raw-office-php-1 php artisan test
```

## Authentication

For this exercise, we will be using a simple authentication method with a API key that must be share between the client and the server.

```
ClaveApiSegura
```

## Endpoints

### GET /api/users

Returns a list of users.

### Curl example

```
curl --location 'http://localhost:8080/api/users' \
--header 'API-KEY: ClaveApiSegura' \
--header 'Accept: application/json' \
```

### Response example

```
[
    {
        "id": 2,
        "name": "Miguel Camargo",
        "email": "miguel1@example.com",
        "phone": "1234567890",
        "is_active": 1,
        "email_verified_at": null,
        "created_at": "2023-12-17T22:58:13.000000Z",
        "updated_at": "2023-12-17T22:58:13.000000Z",
        "deleted_at": null
    },
    {
        "id": 3,
        "name": "Miguel Camargo",
        "email": "miguel2@example.com",
        "phone": "1234567890",
        "is_active": 1,
        "email_verified_at": null,
        "created_at": "2023-12-17T23:05:21.000000Z",
        "updated_at": "2023-12-17T23:05:21.000000Z",
        "deleted_at": null
    }
]
```

### GET /api/users/{id}

Returns a user by id.

### Curl example

```
curl --location 'http://localhost:8080/api/users/2' \
--header 'API-KEY: ClaveApiSegura' \
--header 'Accept: application/json' \
```

### Response example

```
{
    "id": 2,
    "name": "Miguel Camargo",
    "email": "miguel1@example.com",
    "phone": "1234567890",
    "is_active": 1,
    "email_verified_at": null,
    "created_at": "2023-12-17T22:58:13.000000Z",
    "updated_at": "2023-12-17T22:58:13.000000Z",
    "deleted_at": null
}
```

### POST /api/users

Creates a new user.

### Curl example

```
curl --location 'http://localhost:8080/api/users' \
--header 'API-KEY: ClaveApiSegura' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "Miguel Camargo",
    "email": "miguel2@example.com",
    "phone": "1234567890"
}'
```

### Response example

```
{
    "message": "User created successfully",
    "user": {
        "name": "Miguel Camargo",
        "email": "miguel2@example.com",
        "phone": "1234567890",
        "updated_at": "2023-12-17T23:05:21.000000Z",
        "created_at": "2023-12-17T23:05:21.000000Z",
        "id": 3
    }
}
```

### PUT /api/users/{id}

Updates a user by id.

### Curl example

```
curl --location --request PATCH 'http://localhost:8080/api/users/1' \
--header 'API-KEY: ClaveApiSegura' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data '{
    "name": "Miguel Angel Camargo"
}'
```

### Response example

```
{
    "message": "User updated successfully",
    "user": {
        "id": 1,
        "name": "Miguel Angel Camargo",
        "email": "miguel@example.com",
        "phone": "1234567890",
        "is_active": 1,
        "email_verified_at": null,
        "created_at": "2023-12-17T22:29:07.000000Z",
        "updated_at": "2023-12-17T22:48:36.000000Z",
        "deleted_at": null
    }
}
```

### DELETE /api/users/{id}

Deletes a user by id.

### Curl example

```
curl --location --request DELETE 'http://localhost:8080/api/users/1' \
--header 'API-KEY: ClaveApiSegura' \
--header 'Accept: application/json' \
```

### Response example

```
{
    "message": "User deleted successfully"
}
```

You can also find a Postman collection in the root of this project.

`./Users.postman_collection.json`


