## NY Times API Client

## Introduction

Zend Framework module to consume NY Times API

## Installation
Install the module using Composer into your application's vendor directory. Add the following line to your
`composer.json`.

```json
{
    "require": {
        "firelike/nytimes-api": "^1.*"
    }
}
```
## Configuration

Enable the module in your `application.config.php` file.

```php
return array(
    'modules' => array(
        'Firelike\NYTimes'
    )
);
```

Copy and paste the `nytimes.local.php.dist` file to your `config/autoload` folder and customize it with your credentials and
other configuration settings. Make sure to remove `.dist` from your file.Your `nytimes.local.php` might look something like the following:

```php
<?php
return [
    'nytimes_service' => [
        'service_url' => 'http://api.nytimes.com/svc/books/{version}/lists',
        'service_version' => 'v3',
        'api_key' => '<your-api-key>',
    ]
];
```

## Usage

Calling from your code:

```php
        use Firelike\NYTimes\Service\BestSellersService;
        
        $service = new BestSellersService();
        
        $options = [];
        $records = $service->lists($options);
        
        var_dump($records);
        
```

Using the console:

```php
php public/index.php usatoday lists -v
```
## Implemented Service Methods:

* **lists**
* **listNames**



## Links

* [Zend Framework website](http://framework.zend.com)
* [NY Times Developers](https://developer.nytimes.com/)
