## Installation

### Step 1) Get the library

First you need to get a hold of this library. There are two ways of doing this:


#### Method a) Using composer

1. Install Composer (see http://getcomposer.org/)
2. Run `$ composer require hnhdigital-os/php-slack-api`
3. Jump to [step 2](#step-2-start-using-this-package).


#### Method b) Using submodules

Run the following commands to bring in the needed libraries as submodules.

```bash
git submodule add git@github.com:hnhdigital-os/php-slack-api.git vendor/bundles/CL/Slack
```

Add the following two namespace entries to the `registerNamespaces` call in your autoloader:

``` php
// app/autoload.php
$loader->registerNamespaces(array(
    // ...
    'CL\Slack' => __DIR__ . '/../vendor/bundles/cleentfaar/slack',
    // ...
));
```


### Step 2) Start using this package!

Check out the [usage documentation](usage.md)!
