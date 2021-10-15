# php-microframework

A minimal PHP 8 REST API supported
by [php-microframework](https://github.com/johnsquibb/php-microframework).

## Features

- Automatic routing based on URL path, e.g. `https://domain/controller/method/parameters...`

## Development Status

The framework is currently in development and subject to frequent change. A stable version with
tagged release will be made available when ready.

## Installation

`composer create-project johnsquibb/rest-api:dev-main`

## Setup

Point the desired web server at the [public](public) directory and modify the contents
of [index.php](public/index.php) to add additional controller search paths.

## Run

Use the builtin PHP server to serve from the public directory during development:

`php -S localhost:8080 -t public`

Then visit: http://localhost:8080/api to view the demo.

The Demo resource at http://localhost:8080/api/demo provides the following operations:
- GET (collection)
- GET (item)
- POST (create item)
- PUT (update item)
- DELETE (item)
