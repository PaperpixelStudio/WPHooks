# WPHooks

Split Wordpress functions.php file into small, readable hooks.

## Requirement

Your Wordpress files and plugins should be managed by composer.
See [Bedrock boilerplate Wordpress structure](https://github.com/roots/bedrock) to get started.

## Installation

Install with Composer: `composer require paperpixel/wphooks`

## Usage

### Creating a hook

Create a hook by extending `WPHook` class :

```php
use WPHooks\WPHook;

class ExampleHook extends WPHook {
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
feature to import class by namespace with the keyword `use`._

### Using the hook

In your functions.php class, instantiate `ExampleHook` and call `register()` method.

```php
// functions.php
include 'ExampleHook.php';

$example_hook = new ExampleHook();
$example_hook->register();
```



### Easier hook creation with WPHookLoader

You can use `WPHookLoader` to instantiate your hooks easily :

```php
// functions.php

include 'ExampleHook.php';
include 'Hook1.php';
include 'Hook2.php';
include 'Hook3.php';

// You can pass a WPHook instance
WPHooks\WPHookLoader::register(new ExampleHook());

// Or an array of WPHook instances
WPHooks\WPHookLoader::register([
   new Hook1(),
   new Hook2(),
   new Hook3(),
   ...
]);
```

## Autoloading

We can leverage Composer's `ClassLoader` feature in our theme, so that we
don't have to require each hook in `functions.php`.

Considering this theme structure :
```
hooks/
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

$loader->addPsr4('Hooks\\Actions\\', __DIR__ . '/hooks/actions');
$loader->addPsr4('Hooks\\Filters\\', __DIR__ . '/hooks/filters');
```

In your Hook class, add a namespace accordingly to `__autoload.php` :

```php
// hooks/actions/ExampleAction.php

namespace Hooks\Actions;

use WPHooks\WPHook;

class ExampleAction extends WPHook {
    function register() {
        ...
    }
}
```

Finally, in `functions.php`, instantiate your hook :

```php
// functions.php

// Without WPHookLoader
$example_actions = new Actions\ExampleAction();

// With WPHookLoader
WPHooks\WPHookLoader::register(new Actions\ExampleAction());
```