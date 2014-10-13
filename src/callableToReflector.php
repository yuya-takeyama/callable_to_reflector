<?php
namespace yuyat;

/**
 * @param  callable $fn
 * @return Reflector
 */
function callableToReflector($fn)
{
    if (\is_callable($fn)) {
        if (\is_array($fn)) {
            if (\is_object($fn[0])) {
                return new \ReflectionMethod(\get_class($fn[0]), $fn[1]);
            } elseif (\is_string($fn[0])) {
                return new \ReflectionMethod($fn[0], $fn[1]);
            }
        } elseif ($fn instanceof \Closure) {
            return new \ReflectionFunction($fn);
        } elseif (\is_string($fn)) {
            if (strpos($fn, '::') !== false) {
                return new \ReflectionMethod($fn);
            } else {
                return new \ReflectionFunction($fn);
            }
        } elseif (\is_object($fn)) {
            return new \ReflectionMethod(\get_class($fn), '__invoke');
        }
    } else {
        throw new \InvalidArgumentException('argument #1 is not callable');
    }
}
