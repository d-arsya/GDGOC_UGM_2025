
# Google Developer Group on Campus

This project was created to fulfill the requirements for the Google Developer Group on Campus, showcasing my Backend development skills through REST API.

- Language : PHP
- Framework : Laravel
- Database : MySQL

#### Endpoints

| Method | Path     | Description           |
| :- | :- | :- |
| `GET` | `/books` |Get all books data |
| `GET` | `/books/bulk` |Get multiple books by IDs |
| `GET` | `/books/{id}` |Get single book by ID |
| `POST` | `/books` |Create single book |
| `POST` | `/books/bulk` |Create multiple book |
| `PUT` | `/books/{id}` |Update single book |
| `PUT` | `/books/bulk` |Update multiple books |
| `DELETE` | `/books/{id}` |Delete single books |
| `DELETE` | `/books/bulk` |Delete multiple books |
| `GET` | `/books/generate` |Generate dummy data |
| `GET` | `/reset` |Generate a reset token |
| `POST` | `/reset` |Reset the database|


## API Reference

### Get all books

```http
  GET /books
```
- Request
| Parameter | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `page` | `int` |Page number for pagination |`no`|
| `limit` | `int` |Number of items in a page |`no`|
| `order` | `['asc','desc']` |Order of sorting |`no`|
| `sort` | `['title','author','published_at']` |Field to sort |`no`|
- Response
```javascript
{
  "data": [
    {
      "id": 1,
      "title": "Some Book Title",
      "author": "Some Book Author",
      "published_at": "2024-11-19",
      "created_at": "2024-11-19",
      "updated_at": "2024-11-19"
    }
  ],
  "pagination": {
    "current_page": 1,
    "total_pages": 1,
    "per_page": 1,
    "total_items": 1
  },
  "links": {
    "next": null,
    "prev": null
  }
}
```

### Get some books

```http
  GET /books/bulk
```
- Request
| Parameter | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `ids` | `string` |Comma-separated list of book IDs |`yes`|
- Response
```javascript
{
  "message": "Some books were not found",
  "data": [
    {
      "id": 1,
      "success": true,
      "data": {
          "id": 1,
          "title": "Some Book Title",
          "author": "Some Book Author",
          "published_at": "2024-11-19",
          "created_at": "2024-11-19",
          "updated_at": "2024-11-19"
        }      
    },
    {
      "id": 2,
      "success": false,
      "data": null     
    },
  ]
}
```

### Get spesific book

```http
  GET /books/{id}
```
- Request
| Parameter | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `id` | `int` |ID of the book to retrieve |`yes`|
- Response
```javascript
{
  "data": {
      "id": 1,
      "title": "Some Book Title",
      "author": "Some Book Author",
      "published_at": "2024-11-19",
      "created_at": "2024-11-19",
      "updated_at": "2024-11-19"
  }
}
```

### Create single book

```http
  POST /books
```
- Request _(example)_
```javascript
{
  "title": "A Title",
  "author": "An Author",
  "published_at": "2024-11-10"
}
```
| Request Body | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `title` | `string` |Title of the book |`yes`|
| `author` | `string` |Author of the book |`yes`|
| `published_at` | `date` |Published date of the book |`yes`|

- Response _(example)_
```javascript
{
  "message": "Book created successfully",
  "data": {
      "title": "Some Book Title",
      "author": "Some Book Author",
      "published_at": "2024-11-19",
      "created_at": "2024-11-19",
      "updated_at": "2024-11-19"
      "id": 1,
  }
}
```

### Create some books

```http
  POST /books/bulk
```
- Request _(example)_
```javascript
{
  "data": [
    {
      "title": "Some tile",
      "author": "An author",
      "published_at": "2024-11-19"
    },
    {
      "title": "string",
      "author": "string",
    }
  ]
}
```

| Request Body | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `title` | `string` |Title of the book |`yes`|
| `author` | `string` |Author of the book |`yes`|
| `published_at` | `date` |Published date of the book |`yes`|

- Response _(example)_

```javascript
{
  "message": "Some of books not created, required input",
  "data": [
    {
      "title": "Some Title",
      "author": "An Author",
      "published_at": "2024-11-19",
      "created_at": "2024-11-19",
      "updated_at": "2024-11-19",
      "id": 1
    }
  ],
  "failed": [
    {
      "title": "string",
      "author": "string"
    }
  ]
}
```

### Update single book

```http
  PUT /books/{id}
```
- Request _(example)_
| Parameter | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `id` | `int` |ID of the book to retrieve |`yes`|

```javascript
{
  "title": "New Title",
  "author": "New Author",
  "published_date": "2024-12-19"
}
```

| Request Body | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `title` | `string` |Title of the book |`no`|
| `author` | `string` |Author of the book |`no`|
| `published_at` | `date` |Published date of the book |`no`|

- Response
```javascript
{
  "message": "Book updated successfully",
  "data": {
    "data": {
      "id": 2,
      "title": "New Title",
      "author": "New Author",
      "published_at": "2024-12-19",
      "created_at": "2024-11-19",
      "updated_at": "2024-11-19"
    },
    "original": {
      "id": 2,
      "title": "A Book Title",
      "author": "An Author",
      "published_at": "2024-11-19",
      "created_at": "2024-11-19",
      "updated_at": "2024-11-19"
    }
  }
}
```

### Update some books

```http
  PUT /books/bulk
```
- Request
```javascript
{
  "data": [
    {
      "id": 0,
      "title": "string",
      "author": "string",
      "published_at": "2024-11-19"
    },
    {
      "id": 2,
      "title": "NEW DATA",
      "author": "NEW DATA"
    },
  ]
}
```

| Request Body | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `data` | `array` |Array of new books data |`yes`|
| `id` | `int` |ID of the book |`yes`|
| `title` | `string` |Title of the book |`no`|
| `author` | `string` |Author of the book |`no`|
| `published_at` | `date` |Published date of the book |`no`|

- Response
```javascript
{
  "data": [
    {
      "id": 2,
      "success": true,
      "data": {
        "id": 2,
        "title": "NEW DATA",
        "author": "NEW DATA",
        "published_at": "2024-11-19",
        "created_at": "2024-11-19",
        "updated_at": "2024-11-19"
      },
      "original": {
        "id": 2,
        "title": "OLD DATA",
        "author": "OLD DATA",
        "published_at": "2024-11-19",
        "created_at": "2024-11-19",
        "updated_at": "2024-11-19"
      }
    },
    {
      "id": 0,
      "success": false,
      "data": null
    }
  ]
}
```

### Delete single book

```http
  DELETE /books/{id}
```
- Request
| Parameter | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `id` | `int` |ID of the book to delete |`yes`|
- Response
```javascript
{
  "message": "Book deleted successfully"
}
```

### Delete some books

```http
  DELETE /books/bulk
```

- Request
| Parameter | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `ids` | `string` |Comma-separated list of book IDs |`yes`|

- Response
```javascript
{
  "message": "Some of books not deleted successfully",
  "data": [
    {
      "id": "0",
      "success": false
    },
    {
      "id": "2",
      "success": true
    },
  ]
}
```


### Generate dummy data

```http
  GET /books/generate
```
- Request
| Parameter | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `count` | `int` |Count of books to generate |`yes`|

- Response
```javascript
{
  "message": "generate 2 books successfully",
  "count": 2,
  "data": [
    {
      "title": "First book title",
      "author": "First book author",
      "published_at": "2024-11-19",
      "created_at": "2024-11-19",
      "updated_at": "2024-11-19",
      "id": 1
    },
    {
      "title": "Second book title",
      "author": "Second book author",
      "published_at": "2024-11-19",
      "created_at": "2024-11-19",
      "updated_at": "2024-11-19",
      "id": 2
    }
  ]
}
```

### Get database's reset token

```http
  GET /reset
```
- Response
```javascript
{
  "message": "Token generated successfully.",
  "token": "*********",
  "expired_at": "2024-11-19 12:34:56 (20 seconds later)"
}
```
_*token active for only 20 seconds after generated_

### Reset the database

```http
  POST /reset
```
- Request
```javascript
{
  "token": "b1a2c3d4e5f6g7h8i9j0k1l2m3n4o5p6q7r8s9t0u1v2w3x4y5z"
}
```
| Request Body | Type     | Description                | Required     |
| :-------- | :------- | :------------------------- | :------- |
| `token` | `string` |Token retrieved before |`yes`|

- Response

```javascript
{
  "message": "Database has been reset successfully."
}
```









## Deployment Link

[gdgoc.disyfa.site/api](https://gdgoc.disyfa.site/api)

## Documentation

[Documentation](https://gdgoc.disyfa.site/api/documentation)


## Authors

- [@d-arsya](https://www.github.com/d-arsya)

