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

This package provide some config for SSO laravel client that using keycloak for SSO

## Installation

Run this command line for installation :

```bash
composer require diskominfotik-banda-aceh/sso-banda-aceh-php
```

## Usage
- Copy service provider in `app.php` file for laravel < 5.5
```
'providers' => [
    DiskominfotikBandaAceh\SSOBandaAcehPHP\SSOBandaAcehPHPServiceProvider::class
]
```
- Run this command line for make sure the package run properly
```bash
composer dumpautoload
```
- Publish the vendor if you want to use the migration or change the SSO view
```
//Add --tag for specific publish. Ex : --tag=migrations,views,config
php artisan vendor:publish --provider="DiskominfotikBandaAceh\SSOBandaAcehPHP\SSOBandaAcehPHPServiceProvider"
```
- Migrate SSO User
```bash
php artisan migrate
```
- Copy `.env` keycloak in laravel client
```
KEYCLOAK_CLIENT_ID=
KEYCLOAK_CLIENT_SECRET=
KEYCLOAK_REDIRECT_URI=
KEYCLOAK_BASE_URL=
KEYCLOAK_REALM=
KEYCLOAK_PROFILE=
```
- Comment the default auth routes in `web.php` (if the login just using SSO)
```php
//Auth::routes;
```
- [Optional] Setting your `User` model in `sso-banda-aceh.php` config file (if not using the default in `App\Models\User`)
```
'models' => [     
     'users' => User::class
]
```
- [Optional] Setting redirect after login in `sso-banda-aceh.php` config file (if not using the default redirect to `admin.home`)
```
'redirect_after_login' => 'admin.home'
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
