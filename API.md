# API

The API required for completing these exercises has been provided to you.

## Products

### Get all available products

**GET** `/products`

**Response** `200`

Example Data

```json
{
    "data": [
        {
            "id": 1,
            "name": "Product 1",
            "price": 25
        },
        {
            "id": 2,
            "name": "Product 2",
            "price": 15
        },
    ],
    "message": "Products",
    "status": 200,
    "success": true
}
```

### Add a new product

**POST** `/add-product`

**Request**

Example Body
```json
{
    "name": "Product Name",
    "price": 10
}
```

**Response** `200`

Example Data
```json
{
    "data": [
        {
            "id": 1,
            "name": "Product 1",
            "price": 25
        },
        {
            "id": 2,
            "name": "Product Name",
            "price": 10
        }
    ],
    "message": "Saved!",
    "status": 200,
    "success": true
}
```

**Response** `400`

Data
```json
{
    "data": [],
    "message": "Error message",
    "status": 400,
    "success": false
}
```

### Edit existing product

**POST** `/edit-product`

**Request**

Example Body
```json
{
    "id": 1,
    "name": "Product 1",
    "price": 10
}
```

**Response** `200`

Example Data
```json
{
    "data": [
        {
            "id": 1,
            "name": "Product 1",
            "price": 10
        },
        {
            "id": 2,
            "name": "Product Name",
            "price": 10
        }
    ],
    "message": "Saved!",
    "status": 200,
    "success": true
}
```

**Response** `400`

Data
```json
{
    "data": [],
    "message": "Error message",
    "status": 400,
    "success": false
}
```

### Remove product

**POST** `/remove-product`

**Request**

Example Body
```json
{
    "id": 2,
    "name": "Product Name",
    "price": 10
}
```

**Response** `200`

Example Data
```json
{
    "data": [
        {
            "id": 1,
            "name": "Product 1",
            "price": 10
        }
    ],
    "message": "Saved!",
    "status": 200,
    "success": true
}
```

**Response** `400`

Data
```json
{
    "data": [],
    "message": "Could not remove products",
    "status": 400,
    "success": false
}
```

The error message will change based on the [product validation rules](#validation)

### Product Validation <a name="validation"></a>

| Rule                    | Error Message              |
| ----------------------- | -------------------------- |
| Product name exists     | Missing product name       |
| Product name is unique  | Product name is not unique |
| Price exists            | Missing product price      |
| Price is not an integer | Invalid price              |
| Price is less than 1    | Invalid price              |

## Orders

### Get all orders

**GET** `/orders`

**Response** `200`

Example Data
```json
{
    "success": true,
    "message": "Orders",
    "data": [
        {
            "id": 1,
            "fulfilled": false,
            "product_id": 1,
            "when": "2018-01-22 15:26:47",
            "product": {
                "id": 1,
                "name": "Product 1",
                "price": 20
            }
        },
        {
            "id": 2,
            "fulfilled": true,
            "product_id": 3,
            "when": "2018-01-22 15:29:47",
            "product": {
                "id": 3,
                "name": "Product 3",
                "price": 10
            }
        }
    ]
}
```

### Submit an order

**POST** `/submit-order`

**Request**

Example Body
```json
{
    "cart": [
        {
            "id": 2,
            "name": "Product 2",
            "price": 15
        },
        {
            "id": 4,
            "name": "Product 4",
            "price": 10
        }
    ]
}
```

**Response** `200`

Example Data
```json
{
    "data": [
        {
            "id": 1,
            "when": "2018-01-18 15:47:21",
            "product_id": 1
        },
        {
            "id": 2,
            "when": "2018-01-19 13:46:30",
            "product_id": 1
        },
        {
            "id": 3,
            "when": "2018-01-19 13:51:23",
            "product_id": 4
        }
    ],
    "message": "Saved!",
    "status": 200,
    "success": true
}
```

**Response** `400`

Data
```json
{
    "data": [],
    "message": "Could not save orders!",
    "status": 400,
    "success": false
}
```

### Fulfill an order

**POST** `/fulfill`

**Request**

Example Body
```json
{
    "id": 1
}
```

**Response** `200`

Example Data
```json
{
    "success": true,
    "message": "Saved!",
    "data": [
        {
            "id": 1,
            "fulfilled": true,
            "product_id": 1,
            "when": "2018-01-22 15:26:47",
            "product": {
                "id": 1,
                "name": "Product 1",
                "price": 20
            }
        },
        {
            "id": 2,
            "fulfilled": false,
            "product_id": 3,
            "when": "2018-01-22 15:29:47",
            "product": {
                "id": 3,
                "name": "Product 3",
                "price": 10
            }
        }
    ]
}
```

**Response** `400`

Data
```json
{
    "data": [],
    "message": "Could not save orders!",
    "status": 400,
    "success": false
}
```

### Cancel order

**POST** `/cancel-order`

**Request**

Example Body
```json
{
    "id": 1
}
```

**Response** `200`

Example Data
```json
{
    "success": true,
    "message": "Saved!",
    "data": [
        {
            "id": 2,
            "fulfilled": false,
            "product_id": 3,
            "when": "2018-01-22 15:29:47",
            "product": {
                "id": 3,
                "name": "Product 3",
                "price": 10
            }
        }
    ]
}
```

**Response** `400`

Data
```json
{
    "data": [],
    "message": "Could not save orders!",
    "status": 400,
    "success": false
}
```

## Users

### Get all users

**GET** `/users`

**Response** `200`

Example Data
```json
{
    "success": true,
    "message": "Users",
    "data": [
        {
            "id": 1,
            "name": "Test User",
            "password": "testuser",
            "username": "test_user",
            "role": "user",
            "token": "1h7dh3s3hd"
        },
        {
            "id": 2,
            "name": "Test Admin",
            "password": "testadmin",
            "username": "test_admin",
            "role": "admin",
            "token": "1h72ds3hds"
        }
    ],
    "status": 200
}
```

### Get user by ID

**GET** `/users/{id}`

**Response** `200`

Example data
```json
{
    "success": true,
    "message": "User found!",
    "data": {
        "user": {
            "id": 1,
            "username": "test_user",
            "password": "testuser",
            "name": "Test User",
            "role": "user",
            "token": "1k4hd2hf9"
        }
    },
    "status": 200
}
```

**Response** `400`

Example Data
```json
{
    "success": false,
    "message": "No user found for ID",
    "data": {
        "id": "12"
    },
    "status": 400
}
```

### Add new user

**POST** `/add-user`

**Request**

```json
{
    "user": {
        "name": "New User",
        "password": "newuser",
        "username": "new_user",
        "role": "user"
    },
    "repeat": "newuser"
}
```
**Response** `200`

Example Data
```json
{
    "success": true,
    "message": "Users",
    "data": [
        {
            "id": 1,
            "name": "Test User",
            "password": "testuser",
            "username": "test_user",
            "role": "user",
            "token": "1h7dh3s3hd"
        },
        {
            "id": 2,
            "name": "New User",
            "password": "newuser",
            "username": "new_user",
            "role": "user",
            "token": "1h72ds3hds"
        }
    ],
    "status": 200
}
```

**Response** `400`

Example Data
```json
{
    "success": false,
    "message": "Error",
    "data": {
        "username": "message",
        "name": "message",
        "role": "message",
        "password": "message"
    },
    "status": 400
}
```

The data values will change based on the [user validation rules](#uservalidation)

### Edit an existing user

**POST** `/edit-user`

**Request**

Example Body
```json
{
    "user": {
        "id": 1,
        "name": "Test UserUp",
        "password": "newuser",
        "username": "new_user",
        "role": "user",
        "token": "134hd7sr3jd"
    }
}
```
**Response** `200`

Example Data
```json
{
    "success": true,
    "message": "Users",
    "data": [
        {
            "id": 1,
            "name": "Test UserUp",
            "password": "testuser",
            "username": "test_user",
            "role": "user",
            "token": "134hd7sr3jd"
        },
        {
            "id": 2,
            "name": "New User",
            "password": "newuser",
            "username": "new_user",
            "role": "user",
            "token": "1h72ds3hds"
        }
    ],
    "status": 200
}
```

**Response** `400`

Example Data
```json
{
    "success": false,
    "message": "Error",
    "data": {
        "username": "message",
        "name": "message",
        "role": "message",
        "password": "message"
    },
    "status": 400
}
```

The data values will change based on the [user validation rules](#uservalidation)

### Change password

**POST** `/change-password`

**Request**

Example Body
```json
{
    "password": "password",
    "repeat": "password",
    "id": 1
}
```

**Response** `200`

Example Data
```json
{
    "success": true,
    "message": "Users",
    "data": [
        {
            "id": 1,
            "name": "Test UserUp",
            "password": "password",
            "username": "test_user",
            "role": "user",
            "token": "134hd7sr3jd"
        },
        {
            "id": 2,
            "name": "New User",
            "password": "newuser",
            "username": "new_user",
            "role": "user",
            "token": "1h72ds3hds"
        }
    ],
    "status": 200
}
```

**Response** `400`

Example Data
```json
{
    "success": false,
    "message": "Error message",
    "data": [],
    "status": 400
}
```

The error message will change based on the [user validation rules](#uservalidation)

### Delete user

**POST** `/delete-user`

**Request**

Example Body
```json
{
    "id": 1
}
```

**Response** `200`

Example Data
```json
{
    "success": true,
    "message": "Saved",
    "data": [
        {
            "id": 2,
            "name": "New User",
            "password": "newuser",
            "username": "new_user",
            "role": "user",
            "token": "1h72ds3hds"
        }
    ],
    "status": 200
}
```

**Response** `400`

Example Data
```json
{
    "success": false,
    "message": "Error message",
    "data": [],
    "status": 400
}
```

### User validation rules <a name="uservalidation"></a>

The following shows each validation rule and the response message if broken.

| Rule                              | Error Message                         |
| --------------------------------- | ------------------------------------- |
| Username exists                   | Username is required                  |
| Name exists                       | Name is required                      |
| Role exists                       | Role is required                      |
| Password exists                   | Password is required                  |
| Password matches confirmation     | Passwords do not match                |
| Password is at least 6 characters | Password must be 6 characters minimum |
| Username is unique                | Username is not unique                |
