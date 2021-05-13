[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/maciejslawik/php-typesafe-array/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/maciejslawik/php-typesafe-array/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/maciejslawik/php-typesafe-array/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/maciejslawik/php-typesafe-array/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/maciejslawik/php-typesafe-array/badges/build.png?b=master)](https://scrutinizer-ci.com/g/maciejslawik/php-typesafe-array/build-status/master)
[![Latest Stable Version](https://poser.pugx.org/mslwk/php-typesafe-array/v/stable)](https://packagist.org/packages/mslwk/php-typesafe-array)
[![License](https://poser.pugx.org/mslwk/php-typesafe-array/license)](https://packagist.org/packages/mslwk/php-typesafe-array)
[![Total Downloads](https://poser.pugx.org/mslwk/php-typesafe-array/downloads)](https://packagist.org/packages/mslwk/php-typesafe-array)

# PHP type-safe array

This library was designed to provide you with a way of creating type-safe array-like classes.
The ``MSlwk\TypeSafeArray\ObjectArray`` allows you to:
* pass the desired type via constructor (all added objects will be validated against it)
* use the array object like an array (array accessors, foreach support)
* use defined methods to operate

There is also a factory class for ObjectArray class instances creation.

### Installation
Use composer to install the library

```
composer require mslwk/php-typesafe-array
```

## Changelog

See changelog [here](CHANGELOG.md).

## Authors

* [Maciej Sławik](https://github.com/maciejslawik)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details