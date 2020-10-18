# Statamic Livewire
![Statamic 3.0+](https://img.shields.io/badge/Statamic-3.0+-FF269E?style=for-the-badge&link=https://statamic.com)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/jonassiewertsen/statamic-livewire.svg?style=for-the-badge)](https://packagist.org/packages/jonassiewertsen/statamic-livewire)

A [Laravel Livewire](https://laravel-livewire.com/) integration for Statamics Antlers template engine. 

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

### Blade or Antlers? Both!
If creating a Livewire component, you need to render a template file

```
namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public function render()
    {
        return view('livewire.counter');
    }
}
```
More Information: (https://laravel-livewire.com/docs/quickstart#create-a-component)

Normally your template file would be a blade file, named `counter.blade.php`. Great, but what about Antlers?
Rename your template to `counter.antlers.html`, use Antlers syntax and do wathever you like. **No need to change** anything inside your component Controller. How cool is that?

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

## Credits

Thanks to [austenc](https://github.com/austenc) for the Statamic marketplace preview image

## Requirements
- PHP 7.4
- Laravel 7
- Statamic 3

# Support
I love to share with the community. Nevertheless, it does take a lot of work, time and effort. 

[Sponsor me on GitHub](https://github.com/sponsors/jonassiewertsen/) to support my work and the support for this addon.

# License 
This plugin is published under the MIT license. Feel free to use it and remember to spread love.

