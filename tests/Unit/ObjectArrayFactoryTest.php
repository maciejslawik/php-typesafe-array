<?php
declare(strict_types=1);

/**
 * File:ObjectArrayFactoryTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\TypeSafeArray\Test\Unit;

use DateTime;
use MSlwk\TypeSafeArray\ObjectArray;
use MSlwk\TypeSafeArray\ObjectArrayFactory;
use PHPUnit\Framework\TestCase;

/**
 * Class ObjectArrayFactoryTest
 * @package MSlwk\TypeSafeArray\Test\Unit
 */
class ObjectArrayFactoryTest extends TestCase
{
    /**
     * @return void
     */
    public function testFactoryReturnsCorrectClass(): void
    {
        $factory = new ObjectArrayFactory();
        $expected = ObjectArray::class;
        $arrayClass = $factory->create(DateTime::class);
        $this->assertInstanceOf($expected, $arrayClass);
    }
}
