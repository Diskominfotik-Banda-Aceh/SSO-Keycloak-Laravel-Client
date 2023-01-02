Table of contents
=================
<!--ts-->
   * [Table of contents](#table-of-contents)
   * [SSO Banda Aceh PHP](#sso-banda-aceh-php)
      * [Installation](#installation)
      * [Usage](#usage)
      * [Changelog](#changelog)
      * [Contributing](#contributing)
      * [Security](#security)
      * [Credits](#credits)
      * [License](#license)
<!--te-->

# SSO Banda Aceh PHP
[![Latest Version on Packagist](https://img.shields.io/packagist/v/diskominfotik-banda-aceh/sso-banda-aceh-php.svg?style=flat-square)](https://packagist.org/packages/diskominfotik-banda-aceh/sso-banda-aceh-php)
[![Total Downloads](https://img.shields.io/packagist/dt/diskominfotik-banda-aceh/sso-banda-aceh-php.svg?style=flat-square)](https://packagist.org/packages/diskominfotik-banda-aceh/sso-banda-aceh-php)
![GitHub Actions](https://github.com/diskominfotik-banda-aceh/sso-banda-aceh-php/actions/workflows/main.yml/badge.svg)

Package ini berguna untuk memudahkan development aplikasi yang ingin menggunakan SSO Banda Aceh

## Installation

Package bisa dijalankan dengan cara menjalankan command line sebagai berikut :

```bash
composer require diskominfotik-banda-aceh/sso-banda-aceh-php
```

```bash
composer dumpautoload
```

## Usage
- Copy service provider in `app.php` file
```

```
- Run command line composer dumpautoload
```bash
composer dumpautoload
```
- Publish the vendor
- migrate user sso terbaru
- Copy .env keycloak
- Setting model di config
- Tutup auth routes di routes karena sudah berubah ke sso login
```php
// Usage description here
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email diskominfotikbna@gmail.com instead of using the issue tracker.

## Credits

-   [Diskominfotik Banda Aceh](https://github.com/diskominfotik-banda-aceh)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
