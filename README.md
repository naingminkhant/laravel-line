# LARAVEL LINE SDK

This package was created for my project and made it easier for others.

### Installation
``` bash
$ composer require arga/laravel-line:^1.0
```

To publish the config settings:
``` bash
$ php artisan vendor:publish --provider="Arga\LaravelLine\LaravelLineServiceProvider"
```

### Usage SDK

1.Facade
``` bash
$authorize = LaravelLine::authorize();
```

2.Container
``` bash
$line = app(LineManager::class);
$authorize = $line->authorize();
```

### Function

Get authorize url
``` bash
LaravelLine::authorize();
```

Get token
``` bash
$token = LaravelLine::token($request->get('code'));
```

Get profile
``` bash
$profile = LaravelLine::profile($token);
```

Verify token
``` bash
$verify = LaravelLine::verify_token($token);
```

Renew token with refresh token
``` bash
$token = LaravelLine::refresh_token($refresh_token);
```

Logout
``` bash
LaravelLine::logout($token)
```

## License

This package is licensed under MIT. You are free to use it in personal and commercial projects.