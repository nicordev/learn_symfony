# Custom Api

## Requirements

```bash
# PHP
sudo apt-get install php8.0-mbstring
sudo apt-get install php8.0-pdo-pgsql

# PostgreSQL
sudo apt-get install postgresql-client-common

# Symfony CLI
wget https://get.symfony.com/cli/installer -O - | bash
```

## Packages

```bash
# Tests
composer require --dev phpunit
composer require --dev symfony/browser-kit symfony/css-selector

# Maker bundle
composer require doctrine/annotations
composer require symfony/maker-bundle --dev

# serializer
composer require symfony/serializer

# ORM Doctrine
composer require orm
```

## Installation

```bash
make install
```

## Usage

Start the database and the Symfony web server at [https://127.0.0.1:8001](https://127.0.0.1:8001):

```bash
make start
```

Open the home page:

```bash
make browse
```