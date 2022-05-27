# Statamic Livewire
<!-- statamic:hide -->
![Statamic 3.0+](https://img.shields.io/badge/Statamic-3.0+-FF269E?style=for-the-badge&link=https://statamic.com)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/jonassiewertsen/statamic-livewire.svg?style=for-the-badge)](https://packagist.org/packages/jonassiewertsen/statamic-livewire)
<!-- /statamic:hide -->

## Wanna learn Statamic?
Visit my newest project Statamictutorials.com. Many tutorials are free.
[<img src="https://statamictutorials.com/images/seo/statamictutorials.png" width="600" />](https://statamictutorials.com)

## Description
A third-party [Laravel Livewire](https://laravel-livewire.com/) integration for Statamic. 

It's as easy as it get's to get stared with Livewire if using Statamic 3. 

## Installation
Pull in the Livewire package with composer

```bash
composer require jonassiewertsen/statamic-livewire
```

## General documentation
[Laravel Livewire Docs](https://laravel-livewire.com/docs/quickstart)

## Setup inside your template

Include the Livewire styles and scripts __on every page__ that will be using Livewire:

```html
...
    <!-- If using Antlers -->
    {{ livewire:styles }}

    <!-- If using Blade -->
    @livewireStyles
</head>
<body>

    ...
    <!-- If using Antlers -->
    {{ livewire:scripts }}

    <!-- Blade -->
    @livewireScripts
</body>
</html>
```

### Include components
You can create Livewire components as described in the general documentation. To include your Livewire component:
```html
<body>
    <!-- If using Antlers -->
    {{ livewire:your-component-name }}
    
    <!-- If using Blade -->
    <livewire:your-component-name />
</body>
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
<!-- If using Antlers -->
{{ livewire:your-component-name :contact="contact" }}

<!-- If using Blade -->
<livewire:your-component-name :contact="$contact">
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

### Paginating Data
You can paginate results by using the WithPagination trait.

#### Blade
To use pagination with Blade, please use the `Livewire\WithPagination` namespace for your trait as described in the [Livewire docs](https://laravel-livewire.com/docs/2.x/pagination#paginating-data).

### Antlers
Pagination with Antlers does work similar. Make sure to use the `Jonassiewertsen\Livewire\WithPagination` namespace for your trait if working with Antlers. 

In your Livewire component view:
```html
{{ entries }}
    ...
{{ /entries }}

{{ links }}
```

```php
use Jonassiewertsen\Livewire\WithPagination;

class ShowArticles extends Component
{
    use WithPagination;

    protected function entries()
    {
        $entries = Entry::query()
            ->where('collection', 'articles')
            ->paginate(3);

        return $this->withPagination('entries', $entries);
    }

    public function render()
    {
        return view('livewire.blog-entries', $this->entries());
    }
}
```

### Entangle: Sharing State Between Livewire And Alpine
In case you want to share state between Livewire and Alpine, there is a Blade directive called @entangle:\
[Livewire docs](https://laravel-livewire.com/docs/2.x/alpine-js#:~:text=Livewire%20has%20an%20incredibly%20powerful,other%20will%20also%20be%20changed.)

To be usable with Antlers, we do provide an dedicated Tag:
```html
<!-- With Antlers -->
<div x-data="{ open: {{ livewire:entangle property='showDropdown' }} }">
        
<!-- With Blade -->
<div x-data="{ open: @entangle('showDropdown').defer }">
```

### This: Accessing the Livewire component
You can access and perform actions on the Livewire component like this:

```html
<!-- With Antlers -->
{{ livewire:this set="('name', 'Jack')" }}

<!-- With Blade -->
@this.set('name', 'Jack')
```

## Other Statamic Livewire Packages
If using Livewire, those packages might be interesting for you as well:
- [Statamic live search](https://github.com/jonassiewertsen/statamic-live-search)
- [Statamic Livewire Forms](https://github.com/aerni/statamic-livewire-forms)

Did I miss a link? let me know!

## Credits

Thanks to:\
- [Caleb](https://github.com/calebporzio) and the community for building [Livewire](https://laravel-livewire.com/)
- [Austenc](https://github.com/austenc) for the Statamic marketplace preview image

## Requirements
- PHP 7.4 or 8.0
- Laravel 7 or 8
- Statamic 3

# Support
I love to share with the community. Nevertheless, it does take a lot of work, time and effort. 

[Sponsor me on GitHub](https://github.com/sponsors/jonassiewertsen/) to support my work and the support for this addon.

# License 
This plugin is published under the MIT license. Feel free to use it and remember to spread love.

