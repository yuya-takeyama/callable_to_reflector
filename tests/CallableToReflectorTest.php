<?php
namespace yuyat;

class CallableToReflectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideCallable
     */
    public function test_callableToReflector($fn)
    {
        $ref = CallableToReflector($fn);

        $this->assertInstanceOf('ReflectionFunctionAbstract', $ref);
        $this->assertSame(3, $ref->getNumberOfParameters());
    }

    public function provideCallable()
    {
        return array(
            array(function ($x, $y, $z) { return func($x, $y, $z); }),
            array('yuyat\func'),
            array(array($this, 'method')),
            array(array(\get_class($this), 'staticMethod')),
            array(new InvokableObj),
            array('yuyat\CallableToReflectorTest::staticMethod'),
        );
    }

    public function method($x, $y, $z)
    {
        return func($x, $y, $z);
    }

    public static function staticMethod($x, $y, $z)
    {
        return func($x, $y, $z);
    }
}

function func($x, $y, $z)
{
    return ($x + $y) * $z;
}

class InvokableObj
{
    public function __invoke($x, $y, $z)
    {
        return func($x, $y, $z);
    }
}
