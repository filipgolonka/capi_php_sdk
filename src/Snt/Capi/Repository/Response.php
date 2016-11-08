<?php

namespace Snt\Capi\Repository;

use ArrayAccess;
use OutOfBoundsException;

/**
 * @method int getTotal()
 * @method int getCount()
 * @method array getArticles()
 * @method array getTeasers()
 * @method array getSections()
 */
final class Response implements ArrayAccess
{
    const INDEX_IS_NOT_PRESENT_PATTERN = '"%s" index is not present in response';

    private $response;

    /**
     * @param array $response
     *
     * @return self
     */
    public static function createFrom(array $response)
    {
        $self = new self();

        $self->response = $response;

        return $self;
    }

    /**
     * @param string $name
     * @param array $arguments
     *
     * @return array
     * @throws OutOfBoundsException
     */
    public function __call($name, array $arguments)
    {
        $index = mb_strtolower(str_replace('get', '', $name));

        if (isset($this->response[$index])) {
            return $this->response[$index];
        }

        throw new OutOfBoundsException(
            sprintf(self::INDEX_IS_NOT_PRESENT_PATTERN, $index)
        );
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->response[$offset]);
    }

    /**
     * {@inheritDoc}
     */
    public function offsetGet($offset)
    {
        return $this->response[$offset];
    }

    /**
     * {@inheritDoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->response[$offset] = $value;
    }

    /**
     * {@inheritDoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->response[$offset]);
    }
}
