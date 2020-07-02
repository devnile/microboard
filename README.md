# Laravel MicroBoard

[![Latest Version on Packagist](https://img.shields.io/packagist/v/devnile/microboard.svg?style=flat-square)](https://packagist.org/packages/devnile/microboard)
[![Build Status](https://img.shields.io/travis/devnile/microboard/master.svg?style=flat-square)](https://travis-ci.org/devnile/microboard)
[![Quality Score](https://img.shields.io/scrutinizer/g/devnile/microboard.svg?style=flat-square)](https://scrutinizer-ci.com/g/devnile/microboard)
[![Total Downloads](https://img.shields.io/packagist/dt/devnile/microboard.svg?style=flat-square)](https://packagist.org/packages/devnile/microboard)

This package was created to reduce the time spent on creating dashboards, with a small, robust package.
It comes with users, roles, permissions and settings resources. This means that when installing this package you will be able to manage those resources. And now it's your time to add more with simple commands.
The design created by Creative Tim to make the dashboard tidy and carefully designed.

## Installation

You can install the package via composer:

```bash
composer require devnile/microboard
```

## Usage
First you need to make your User's model extends from Microboard's User

```php
use Microboard\Models\User as Microboard;

class User extends Microboard
````

Now we need to install the package's assets. Do the following in your Terminal:
```shell script
php artisan microboard:install
```

It will ask you if you want a new admin, do this if you want.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.
