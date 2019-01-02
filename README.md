#Movie Edge Service

Public facing service that proxy requests from external users to multiple Microservices.

- [Stack](#stack)
- [Installation](#installation)
- [Running](#running)

## Stack

* Symfony 4.2
* PHP 7.1

## Installation

Let's clone the repo from github using the following command:

```
$ git clone git@github.com:mookofe/movie-edge-service.git
```

Next step install Symfony dependencies running:

```
$ cd movie-edge-service
$ composer install
```

Setup environment varialbles:

```batch
$ cp .env.dist .env
```

Run tests:

```batch
$ bin/phpunit
```

## Basic Usage:
Run the application using the following command:

```batch
$ php -S localhost: 8001 -t public
```

Finally open your browser using the url: `http://localhost:8001/api`