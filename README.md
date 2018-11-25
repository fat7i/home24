### Technology
I built a framework specified for this task, I used PHP7, Mysql and [JWT (JSON Web Token)](https://jwt.io/) for authentication, 
and finally [Composer](https://getcomposer.org/) as a package manager.

### Instructions
- Edit database info in `resources/config.php` file.
- Import `resources/database.sql` into database, it's contain schema and some demo data. 
- From your terminal run: `composer update` to download all packages.


#### Demo Account
- Use [Postman](https://www.getpostman.com) to test the endpoints,
    - Demo account:
        - **Email:** admin@test.com
        - **Password:** 123456

## Endpoints
Configure your virtual host to `/public` folder, it contains the front controller, Otherwise all URLs will goes like `../public/products`.

### 1. User Endpoints
| Name | Method | URL |
|------|------|------|
| Register | POST | /register
| Login | POST | /login 
| Logout | POST | /logout

#### 1.1. User Register

    POST /register
    Content-Type: application/json
    
    Payload:
        {
            "name": "Username",
            "email": "username@domain.com",
            "password": "123456",
            "password_confirmation": "123456"
        }
    Response:
        {
            "token": "..."
        }

#### 1.2. User login

    POST /login
    Content-Type: application/json
    Payload:
        {
          "email": "admin@test.com",
          "password": "123456"
        }

#### 1.3. User logout

    GET /logout
    Content-Type: application/json
    Authorization: Bearer [token]
    Response:
        {
            "status": "success",
            "message": "logged out successfully."
        }

---

### 2. Products Endpoints
| Name | Method | URL 
|------|------|------|
| List | GET | /products
| Get | GET | /products/{id}
| Create | POST | /products
| Update | PUT | /products/{id}
| Delete | DELETE | /products/{id}

#### 2.1. Products list

    GET /products   optional: add (?page=2) for paging
    Authorization: Bearer [token]
    Response: 200 OK
        {
            "current_page": 1,
            "data": [
                {
                    "id": 1,
                    "title": "...",
                    "description": "...",
                    "created_at": "2018-...",
                    "updated_at": "2018-...",
                    "deleted_at": null,
                    "user": {...},
                    "categories": [
                        {...}
                     ]
                },
                {...}
            ],
            "per_page": 10,
            "total": 50,
            "last_page": 5
        }

#### 2.2. Get One Product

    GET /products/{id}
    Authorization: Bearer [token]
    Response: 200 OK
        {
            "id": 1,
            "title": "...",
            "description": "...",
            "created_at": "2018-...",
            "updated_at": "2018-...",
            "deleted_at": null,
            "user": {...},
            "categories": [
                {...}
             ]
        }

#### 2.3. Create Product

    POST /products
    Authorization: Bearer [token]
    Payload:
        {
            "title": "...",
            "description": "...",
            "categories": [1,2,3] //array of categories_ids 
        }
    Response: 201 Created
        {
            "id": ..
            "title": "...",
            "description": "...",
            "updated_at": "2018-...",
            "created_at": "2018-...",
            "user": {...},
                        "categories": [
                            {...}
                         ]
        }

#### 2.4. Update Product

    PUT /api/products/{id}
    Authorization: Bearer [token]
    Payload:
        {
            "title": "...",
            "description": "...",
            "categories": [..categories_ids..]
        }
    Response: 200 OK
        {
            "id": ..
            "title": "...",
            "description": "...",
            "updated_at": "2018-...",
            "created_at": "2018-...",
            "user": {...},
                        "categories": [
                            {...}
                         ]
        }

#### 2.5. Delete Product

    DEL /api/products/{id}
    Authorization: Bearer [token]

    Response: 204 No Content

---

### About API
- it use [JWT (JSON Web Token)](https://jwt.io/) for authentication.
- it use a random complicated key (JWT Secret) to run brute forcing the token very hard.
- it limit requests (Throttling) to avoid DDoS / brute-force attacks.
- it return the proper status code according to the operation completed. (e.g. `200 OK`, `400 Bad Request`, `401 Unauthorized`, `405 Method Not Allowed`, etc).
- it return and json response, `content-type: application/json`.
- it remove fingerprinting headers.

### Have a Query?
Mail me at [bin.fathi.ali@gmail.com](mailto:bin.fathi.ali@laravel.com)    