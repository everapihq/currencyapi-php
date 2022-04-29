<p align="center">
<img src="https://app.currencyapi.com/img/logo/currencyapi.png" width="300"/>
</p>

# currencyapi-php - PHP Currency Converter

[![Latest Version on Packagist](https://img.shields.io/packagist/v/everapi/currencyapi-php.svg?style=flat-square)](https://packagist.org/packages/everapi/currencyapi-php)
[![Total Downloads](https://img.shields.io/packagist/dt/everapi/currencyapi-php.svg?style=flat-square)](https://packagist.org/packages/everapi/currencyapi-php)

This package is a PHP wrapper for [currencyapi.com] that aims to make the usage of the API as easy as possible in your project.

## Installation

You can install the package via composer:

```bash
composer require everapi/currencyapi-php
```

## Usage

```php
$currencyApi = new \CurrencyApi\CurrencyApi\CurrencyApiClient('YOUR-API-KEY');
echo $currencyApi->latest([
    'base_currency' => 'EUR',
    'currencies' => 'USD',
]);
```

Endpoints accessible with a free account:
- `status`
- `latest`
- `historical`

These advanced endpoints currently require a paid subscription:
- `convert`
- `range`

Find out more about our endpoints, parameters and response data structure in the [docs].

[docs]: https://currencyapi.com/docs
[currencyapi.com]: https://currencyapi.com

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
