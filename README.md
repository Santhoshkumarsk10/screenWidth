## About Screenwidth
Screenwidth is a PHP Laravel package with an easy-to-use syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Screenwidth takes the pain out of development by simplifying common tasks used in many web projects, such as:

Easy-to-use helper functions

Detect device type based on screen width

Check for a specific device type

Screenwidth is accessible, powerful, and acts as a handy tool required for large, robust applications.


## Using Screenwidth
Unlike CSS-based media queries that react in real-time as the user resizes the window, this package debounces the network request and updates the view on the next page load. This makes it more reliable for backend-based rendering logic.


## Installation
```
composer require scwi/screen-width v2
```


## Default Breakpoints

The default breakpoints are shown below:

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

If you want to customize the breakpoints, you can create your own config file and override the default values.

```php
config/screenWidth.php
```
This is a powerful option that gives developers full control based on their app needs.

## Loader

(This step is optional)

Only one time (in first load of application), you will get the message that says we are checking device width to give you the best view of the website. You can customize that UI by creating a file and giving own HTML.

```php
resources/views/vendor/screenWidth/screenWidthLoader.blade.php
```


## Middleware

he middleware is already provided with the package. You just need to apply it to your routes.

Middleware Name: screenWidth

Example: Apply to all routes in web.php

```php
screenWidth
```

Example 1: Apply complete to the web.php file
```php
app/Providers/RouteServiceProvider.php

Route::middleware(['web','screenWidth'])->namespace($this->namespace)->group(base_path('routes/web.php'));
```

## On Screen Resize Event

All the resize detection code is prebuilt and ready to use. Just include this file in your main layout (e.g. app.blade.php) or in your login/register views:

```php
@include('screenWidth::screenWidth.reportWindowSize')
```
This ensures the screen width is captured properly during resizing.

## Helpers

The package provides the following helper functions:

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

Thanks for considering contributing to this tool!

Developed by: Palanikumar (https://www.instagram.com/palanikumar_45)


## Security Vulnerabilities & Suggestions

If you have suggestions or find a security vulnerability, please send an email to Santhoshkumar B via bsanthoshkumar10@gmail.com. All issues will be promptly addressed, and we welcome collaboration on improvements.

## License

The MIT License (MIT). Please see the License File for more information.
