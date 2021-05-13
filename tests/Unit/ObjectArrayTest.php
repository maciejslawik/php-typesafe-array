<?php
declare(strict_types=1);

/**
 * File:ObjectArrayTest.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\TypeSafeArray\Test\Unit;

use ArrayIterator;
use DateTime;
use DateTimeImmutable;
use InvalidArgumentException;
use MSlwk\TypeSafeArray\ObjectArray;
use PHPUnit\Framework\TestCase;

/**
 * Class ObjectArrayTest
 * @package MSlwk\TypeSafeArray\Test\Unit
 */
class ObjectArrayTest extends TestCase
{
    /**
     * @dataProvider provideDifferentIterables
     * @param iterable $iterable
     * @return void
     */
    public function testOperationsOnArray(iterable $iterable): void
    {
        $object1 = new DateTime();
        $object2 = new DateTime();
        $object3 = new DateTime();
        $object4 = new DateTime();
        $iterable[] = $object2;
        $objectArray = new ObjectArray(DateTime::class, $iterable);
        $objectArray[1] = $object3;
        $objectArray->offsetSet(2, $object4);
        $objectArray->add($object1);

        $this->assertSame($object2, $objectArray->offsetGet(0));
        $this->assertSame($object3, $objectArray[1]);
        $this->assertSame($object4, $objectArray[2]);
        $this->assertSame($object1, $objectArray[3]);

        $this->assertSame($object2, $objectArray->current());
        $objectArray->next();
        $objectArray->next();
        $this->assertSame($object4, $objectArray->current());
        $objectArray->rewind();
        $this->assertSame($object2, $objectArray->current());

        $this->assertEquals(4, $objectArray->count());
        $objectArray->offsetUnset(2);
        $this->assertEquals(3, $objectArray->count());

        $this->assertTrue($objectArray->offsetExists(1));
        $this->assertFalse($objectArray->offsetExists(2));

        $this->assertTrue($objectArray->valid());

        $this->assertEquals(0, $objectArray->key());
        $objectArray->next();
        $this->assertEquals(1, $objectArray->key());
    }

    /**
     * @dataProvider provideDifferentIterables
     * @param iterable $iterable
     * @return void
     */
    public function testAddingWrongTypeViaConstructor(iterable $iterable): void
    {
        $this->expectException(InvalidArgumentException::class);

        $object = new DateTimeImmutable();
        $iterable[] = $object;
        new ObjectArray(DateTime::class, $iterable);
    }

    /**
     * @return void
     */
    public function testAddingWrongTypeViaOffsetSet(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $object = new DateTimeImmutable();
        $objectArray = new ObjectArray(DateTime::class);
        $objectArray->offsetSet(0, $object);
    }

    /**
     * @return void
     */
    public function testAddingWrongTypeViaAdd(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $object = new DateTimeImmutable();
        $objectArray = new ObjectArray(DateTime::class);
        $objectArray->add($object);
    }

    /**
     * @return void
     */
    public function testAddingWrongTypeViaArrayAccess(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $object = new DateTimeImmutable();
        $objectArray = new ObjectArray(DateTime::class);
        $objectArray[0] = $object;
    }

    /**
     * @return array
     */
    public function provideDifferentIterables(): array
    {
        return [
            'plain_array' => [
                []
            ],
            'iterator' => [
                new ArrayIterator()
            ]
        ];
    }
}
