# WPModules

Split Wordpress functions.php file into small, readable modules

## Installation

Install with Composer: `Composer require paperpixel/wpmodules`

## Usage

### Creating a module

Create a module by extending `WPModule` class :

```php
use WPModules\WPModule;

class ExampleModule extends WPModule {

}
```

_Note: we take advantage of Composer autoload
feature to import class by namespace._

### Registering actions or filters

In your new class `ExampleModule`, register a filter or an action :
```php
use WPModules\WPModule;

class ExampleModule extends WPModule {
    public function register() {
        $this->add_action('init', 'my_action');
        $this->add_filter('the_title', 'my_filter');
    }

    private function my_action() {
        // Stuff here will be called by Wordpress
    }

    private function my_filter($title) {
        // Stuff here will be called by Wordpress
    }
}

```

### Using the module

In your functions.php class, instantiate `ExampleModule` and call `register()` method.

```php
// functions.php
include 'ExampleModule.php';

$example_module = new ExampleModule();
$example_module->register();
```



### Easier module creation with WPModuleFactory

You can use `WPModuleFactory` to instantiate your modules easily :

```php
// functions.php
use WPModules\WPModuleFactory;

include 'ExampleModule.php';

WPModuleFactory::add(new ExampleModule());

```