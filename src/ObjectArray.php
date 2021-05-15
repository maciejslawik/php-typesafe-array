<?php
declare(strict_types=1);

/**
 * File:ObjectArray.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\TypeSafeArray;

use ArrayAccess;
use ArrayIterator;
use Countable;
use InvalidArgumentException;
use Iterator;
use function get_class;

/**
 * Class ObjectArray
 * @package MSlwk\TypeSafeArray
 */
class ObjectArray implements Countable, ArrayAccess, Iterator
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var ArrayIterator
     */
    private $iterator;

    /**
     * ObjectArray constructor.
     * @param string $type
     * @param iterable $objects
     * @throws InvalidArgumentException
     */
    public function __construct(string $type, iterable $objects = [])
    {
        $this->type = $type;
        $this->iterator = new ArrayIterator();
        foreach ($objects as $object) {
            $this->add($object);
        }
    }

    /**
     * @param $value
     * @return void
     * @throws InvalidArgumentException
     */
    public function add($value): void
    {
        $this->validateObjectType($value);
        $this->iterator->append($value);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return $this->iterator->offsetExists($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->iterator->offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     * @return void
     * @throws InvalidArgumentException
     */
    public function offsetSet($offset, $value): void
    {
        $this->validateObjectType($value);
        $this->iterator->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset($offset): void
    {
        $this->iterator->offsetUnset($offset);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->iterator->count();
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->iterator->current();
    }

    /**
     * @return void
     */
    public function next(): void
    {
        $this->iterator->next();
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return $this->iterator->key();
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return $this->iterator->valid();
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->iterator->rewind();
    }

    /**
     * @param $object
     * @return void
     * @throws InvalidArgumentException
     */
    private function validateObjectType($object): void
    {
        if (!$object instanceof $this->type) {
            throw new InvalidArgumentException(
                sprintf(
                    'Object of invalid class passed. Expected: %s. Actual: %s',
                    $this->type,
                    get_class($object)
                )
            );
        }
    }
}
