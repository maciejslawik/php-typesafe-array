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
     * @param array $objects
     * @throws InvalidArgumentException
     */
    public function __construct(string $type, array $objects = [])
    {
        $this->type = $type;
        foreach ($objects as $object) {
            $this->validateObjectType($object);
        }
        $this->iterator = new ArrayIterator($objects);
    }

    /**
     * @param $value
     * @throws InvalidArgumentException
     */
    public function add($value)
    {
        $this->validateObjectType($value);
        $this->iterator->append($value);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
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
     * @throws InvalidArgumentException
     */
    public function offsetSet($offset, $value)
    {
        $this->validateObjectType($value);
        $this->iterator->offsetSet($offset, $value);
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->iterator->offsetUnset($offset);
    }

    /**
     * @return int
     */
    public function count()
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
    public function next()
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
    public function valid()
    {
        return $this->iterator->valid();
    }

    /**
     * @return void
     */
    public function rewind()
    {
        $this->iterator->rewind();
    }

    /**
     * @param $object
     * @throws InvalidArgumentException
     */
    private function validateObjectType($object)
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
