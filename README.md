## About Screenwidth

Screenwidth is a php laravel package with easy to use syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Screenwidth takes the pain out of development by easing common tasks used in many web projects, such as:

- Easy to use helper functions.
- Get device type based on width.
- Check for a specific device type.

Screenwidth is accessible, powerful, and acts as a tools required for large, robust applications.


## Using Screenwidth
When using css, the content of the page will update in realtime as the user resizes the window,
whereas this package debounces a network request and updates the page on the next page request.


## Installation
```
composer require santhosh/screen-width
```


## Default Breakpoints

Default breakpoints are given below:

```php
<?php
return [
  'devices' => [
    'mobile' => [
      'min' => 0,
      'max' => 576
    ],
    'tablet' => [
      'min' => 576,
      'max' => 992
    ],
    'desktop' => [
      'min' => 992,
      'max' => 10000
    ],
  ],
  'auto_reload' => true,
  'exceptUrls' => [
    
  ],
];
```


## Custom Breakpoints

(This step is optional)

If you want to change the breakpoints as per your need then please create a file in below location and then overwrite the values as per your need. It is a very powerful setting that gives full freedom to the developer to customize according to the requirement.

```php
config/screenwidth.php
```

## Loader

(This step is optional)

Only one time (in first load of application), you will get the message that says we are checking device width to give you the best view of the website. You can customize that UI by creating a file and giving own HTML.

```php
resources/views/vendor/screenwidth/screenwidth_loader.blade.php
```


## Middleware

Middleware is already created by the vendor you just need to apply this middleware in your route group.

```php
screenwidth
```

Example 1: Apply complete to the web.php file
```php
app/Providers/RouteServiceProvider.php

Route::middleware(['web','screenwidth'])
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
```

Example 2: Apply to specific route group
```php
Route::group(['prefix' => '', 'middleware' => ['your_middleware_1','screenwidth']], function()
{
  Route::get('/route_1', 'AppController@method1');
  Route::get('/', 'AppController@landing');
});
```



## On Screen Resize Event

All the code is readymade and ready to use. You don't need to worry about any coding, just include this file and resize will start working. It's important that you place it in the layout file for your application to look its best. I have it in my layout file `app.blade.php` and on the `login`/`register` pages. 

```php
@screenwidth_reportWindowSize
```

Alternatively you can use the below code only if above directive doesn't work for you due to any version issue.

```php
@include('screenwidth::screenwidth.reportWindowSize')
```


## Helpers

Helpers function are already created by the vendor and you just need to call the function directly and use it in your code.

```php
// To get the width of the client screen.

screenwidth_get()
// Output: 1234

// To get the device type based on width and breakpoints given in config file

screenwidth_device()
// Output: desktop

// Check if the device is that type based on parameter and config file

screenwidth_is('desktop')
// Output: true / false

```



## Contributing

Thank you for considering contributing to this tool!

[Palani Kumar](https://www.instagram.com/palanikumar_45)


## Security Vulnerabilities & Suggestions

If you have any suggestions or if you discover a security vulnerability, please send an e-mail to Santhoshkumar B via [bsanthoshkumar10@gmail.com](mailto:bsanthoshkumar10@gmail.com). All security vulnerabilities will be promptly addressed and we can collaborate on the suggestions

## License

The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.
