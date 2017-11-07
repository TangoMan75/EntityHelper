<?php

namespace TangoMan\EntityHelper\Traits;

/**
 * Trait JsonSerializable
 * Class must have `implements \JsonSerializable`
 *
 * @package TangoMan\EntityHelper\Traits
 */
trait JsonSerializable
{
    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
