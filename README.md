
<br/>
<div align="center">

<h3 align="center">Eunit</h3>
<p align="center">
Make WordPress PHPUnit less painful
<br/>
<br/>
<a href="https://elementor.github.io/eunit/"><strong>Explore the docs »</strong></a>
<br/>
<br/>
  
<a href="https://github.com/elementor/eunit/issues/new?labels=bug&template=bug-report---.md">Report Bug .</a>
<a href="https://github.com/elementor/eunit/issues/new?labels=enhancement&template=feature-request---.md">Request Feature</a>
</p>
</div>

## About The Project

Eunit is a php library to make WordPress PHPUnit less painful. Eunit is a collection of Test cases, common WordPress test helpers, and a few DB helpers to make the developer's life a little easier.
## Getting Started

Getting started with Eunit is simple and quick, just make sure you follow this guide.
### Installation

#### Composer
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

#### Manually
You can also install Eunit via git,

```bash
git clone https://github.com/elementor/eunit.git
```
Then you need to do is make sure to include Eunit instance in your PHPUnit bootstrap.php

```php
// Require eunit.php
// Pending on your directory structure
require_once dirname( dirname( __FILE__ ) ) . '/eunit/eunit.php';
\Eunit\Eunit::instance();
```

### Configuration
Before actually using Eunit you need to add a few environment variables to you PHPUnit runtime which can be done be editing your `phpunit.xml` in the <php> element.

`EUNIT_TEST_CASE_NAMESPACE` should be set to the plugin main namespace

```xml
<php>
    <env name="EUNIT_TEST_CASE_NAMESPACE" value="YourMainNamespace">
</php>
```
All that is left is to start using Eunit, head over to the [Docs to learn more](https://elementor.github.io/eunit/).
