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
    private string $type;
    private ArrayIterator $iterator;

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
        foreach ($objects as $key => $object) {
            $this->offsetSet($key, $object);
        }
    }

    /**
     * @param mixed $value
     * @return void
     * @throws InvalidArgumentException
     */
    public function add(mixed $value): void
    {
        $this->validateObjectType($value);
        $this->iterator->append($value);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->iterator->offsetExists($offset);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->iterator->offsetGet($offset);
    }

    /**
     * @param mixed $offset
     * @param object $value
     * @return void
     * @throws InvalidArgumentException
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->validateObjectType($value);
        $this->iterator->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
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
    public function current(): mixed
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
    public function key(): mixed
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
     * @param mixed $object
     * @return void
     * @throws InvalidArgumentException
     */
    private function validateObjectType(mixed $object): void
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
