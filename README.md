# yuyat\callableToReflector

Transforms any `callable` value into `Reflector`.

## Usage

```php
<?php
use function callableToReflector;

$reflector = callableToReflector(function ($x) { return $x; }); // => ReflectionFunction
$reflector = callableToReflector('func');                       // => ReflectionFunction
$reflector = callableToReflector([$obj, 'method']);             // => ReflectionMethod
$reflector = callableToReflector(['Klass', 'method']);          // => ReflectionMethod
$reflector = callableToReflector($invokableObj);                // => ReflectionMethod
$reflector = callableToReflector('Klass::method');              // => ReflectionMethod
```

## Author

Yuya Takeyama
