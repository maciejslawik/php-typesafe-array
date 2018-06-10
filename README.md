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

## Authors

* [Maciej Sławik](https://github.com/maciejslawik)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details