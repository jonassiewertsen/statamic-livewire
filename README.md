# Statamic Livewire
![Statamic 3.0+](https://img.shields.io/badge/Statamic-3.0+-FF269E?style=for-the-badge&link=https://statamic.com)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/jonassiewertsen/statamic-livewire.svg?style=for-the-badge)](https://packagist.org/packages/jonassiewertsen/statamic-livewire)

A [Laravel Livewire](https://laravel-livewire.com/) integration for Statamics Antlers template engine. 

## Help wanted!
This version it fully experimental right now and I am still tinkering around with it.

Feel free to contribute to this addon, to make the integration for Statamics Antlers engine great and fun to use.

## requires
- PHP 7.4
- Laravel 7
- Statamic V3

## Installation
Pull in your package with composer
```bash
composer require jonassiewertsen/statamic-livewire
```

## General documentation
[Laravel Livewire Docs](https://laravel-livewire.com/docs/quickstart)

## How to be used with the Antlers template engine

Include the JavaScript (on every page that will be using Livewire).

```html
...
    {{ livewire:styles }}
</head>
<body>

    ...
    {{ livewire:scripts }}
</body>
</html>
```

### Include components with Antlers
You can create Livewire components as described in the general documentation. To include your Livewire component:
```html
<head>
    ...
    {{ livewire:styles }}
</head>
<body>
    {{ livewire:your-component-name }}

    ...

    {{ livewire:scripts }}
</body>
</html>
```

### Passing Initial Parameters
You can pass data into a component by passing additional parameters
```html
{{ livewire:your-component-name contact="contact" }}
```

To intercept with those parameters, mount them and store the data as public properties.

```php
use Livewire\Component;

class ShowContact extends Component
{
    public $name;
    public $email;

    public function mount($contact)
    {
        $this->name = $contact->name;
        $this->email = $contact->email;
    }

    ...
}
```

The [Official Livewire documentation](https://laravel-livewire.com/docs/rendering-components)

# License 
This plugin is published under the MIT license. Feel free to use it and remember to spread love.

