# WPModules

Split Wordpress functions.php file into small, readable modules.

## Installation

Install with Composer: `Composer require paperpixel/wpmodules`

## Usage

### Creating a module

Create a module by extending `WPModule` class :

```php
use WPModules\WPModule;

class ExampleModule extends WPModule {
    // Mandatory method, used to register actions and filters with Wordpress.
    public function register() {
        $this->add_action('init', 'my_action_hook');
        $this->add_filter('the_title', 'my_filter_hook');
    }

    private function my_action_hook() {
        // Stuff here will be called by Wordpress
    }

    private function my_filter_hook($title) {
        // Stuff here will be called by Wordpress
    }
}
```

_Note: we take advantage of Composer autoload
feature to import class by namespace with the keyword `use`.

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

include 'ExampleModule.php';
include 'Module1.php';
include 'Module2.php';
include 'Module3.php';

// You can pass a WPModule instance
WPModules\WPModuleFactory::add(new ExampleModule());

// Or an array of WPModule instances
WPModules\WPModuleFactory::add([
   new Module1(),
   new Module2(),
   new Module3(),
   ...
]);
```

## Autoloading

We can leverage Composer's `ClassLoader` feature in our theme, so that we
don't have to require each module in `functions.php`.

Considering this theme structure :
```
modules/
    actions/
        ExampleAction.php
    filters/
        ExampleFilter.php
__autoload.php
functions.php
```

Start by creating the `__autoload.php` file :

```php
// __autoload.php

use Composer\Autoload\ClassLoader;

$loader = new ClassLoader();
$loader-> register();

$loader->addPsr4('Actions\\', __DIR__ . '/modules/actions');
$loader->addPsr4('Filters\\', __DIR__ . '/modules/filters');
```

In your Module class, add a namespace accordingly to `__autoload.php` :

```php
// modules/actions/ExampleAction.php

namespace Actions;

use WPModules\WPModule;

class ExampleAction extends WPModule {
    function register() {
        ...
    }
}
```

Finally, in `functions.php`, instantiate your module :

```php
// functions.php

// Without WPModuleFactory
$example_actions = new Actions\ExampleAction();

// With WPModuleFactory
WPModules\WPModuleFactory::add(new Actions\ExampleAction());
```