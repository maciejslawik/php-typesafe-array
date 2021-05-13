<?php
declare(strict_types=1);

/**
 * File:ObjectArrayFactory.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github:      https://github.com/maciejslawik
 */

namespace MSlwk\TypeSafeArray;

use InvalidArgumentException;

/**
 * Class ObjectArrayFactory
 * @package MSlwk\TypeSafeArray
 */
class ObjectArrayFactory
{
    /**
     * @param string $type
     * @param iterable $objects
     * @return ObjectArray
     * @throws InvalidArgumentException
     */
    public function create(string $type, iterable $objects = []): ObjectArray
    {
        return new ObjectArray($type, $objects);
    }
}
