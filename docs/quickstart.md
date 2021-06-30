# Quick start
Getting started with Eunit is simple and quick, just make sure you follow this guide.

## Installation
### Composer
To install Eunit, via composer run the command below, and you will get the latest version

```bash
composer require --dev elementor/eunit
```

then you need to do is make sure to include composer autoloader in your PHPUnit `bootstrap.php`

```php
// Require composer dependencies.
// Pending on your vendor directory
require_once dirname( dirname( __FILE__ ) ) . '/vendor/autoload.php';
```
### Manually 
You can also install Eunit via git,
```bash
git clone https://github.com/elementor/eunit.git
```
Then you need to do is make sure to include Eunit instance in your PHPUnit `bootstrap.php`
```php
// Require eunit.php
// Pending on your directory structure
require_once dirname( dirname( __FILE__ ) ) . '/eunit/eunit.php';
\Eunit\Eunit::instance();
```

## Configuration
Before actually using Eunit you need to add a few environment variables to you PHPUnit runtime which can be done be editing your `phpunit.xml` in the `<php>` element.

`EUNIT_TEST_CASE_NAMESPACE` should be set to the plugin main namespace
```xml
<php>
    <env name="EUNIT_TEST_CASE_NAMESPACE" value="ElementorMainNamespace">
</php>
```

All that is left is to start using Eunit.
