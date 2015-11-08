# Alt Three Sentry

A Sentry bridge for Laravel 5.


## Installation

Either [PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.6+ are required.

To get the latest version of Alt Three Sentry, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require alt-three/sentry
```

Instead, you may of course manually update your require block and run `composer update` if you so choose:

```json
{
    "require": {
        "alt-three/sentry": "^1.0"
    }
}
```

Once Alt Three Sentry is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'AltThree\Sentry\SentryServiceProvider'`


## Security

If you discover a security vulnerability within this package, please e-mail us at support@alt-three.com. All security vulnerabilities will be promptly addressed.


## License

Alt Three Sentry is licensed under [The MIT License (MIT)](LICENSE).
