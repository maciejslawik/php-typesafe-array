<?php
declare(strict_types=1);

/**
 * File:ObjectArrayFactoryTest.php
 *
 * @author Maciej Sławik <maciej.slawik@lizardmedia.pl>
 * @copyright Copyright (C) 2018 Lizard Media (http://lizardmedia.pl)
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
     * @test
     */
    public function testFactoryReturnsCorrectClass()
    {
        $factory = new ObjectArrayFactory();

        $expected = ObjectArray::class;

        $arrayClass = $factory->create(DateTime::class);

        $this->assertInstanceOf($expected, $arrayClass);
    }
}
