<?php

namespace Morilog\PhpEnum;

use Assert\Assertion;

/**
 * Class Enum
 * @package Morilog
 */
abstract class Enum
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var mixed
     */
    private $value;

    /**
     * Enum constructor.
     * @param $value
     */
    public function __construct($value)
    {
        Assertion::scalar($value);
        Assertion::inArray($value, static::values());

        $this->value = $value;
        $this->key = array_search($value, static::toArray(), true);
    }

    /**
     * @return array
     */
    public static function values(): array
    {
        return array_values(static::toArray());
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function toArray(): array
    {
        return (new \ReflectionClass(static::class))->getConstants();
    }

    /**
     * @param string $key
     * @return Enum
     */
    public static function fromKey(string $key): self
    {
        Assertion::keyExists(static::keys(), $key);

        return new static(static::keys()[$key]);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function keys(): array
    {
        return array_keys(static::toArray());
    }

    /**
     * @param $value
     * @return Enum
     */
    public static function fromValue($value): self
    {
        return new static($value);
    }

    /**
     * @param $state
     * @return Enum
     */
    public static function __set_state($state)
    {
        return new static($state['value']);
    }

    /**
     * @param $name
     * @param $arguments
     * @return Enum
     * @throws \ReflectionException
     */
    public static function __callStatic($name, $arguments)
    {
        foreach (static::toArray() as $key => $value) {
            $method = Str::camel(Str::lower($key));

            if ($name === $method) {
                return new static($value);
            }
        }

        throw new \BadMethodCallException(sprintf('Method %s does not exists', $name));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->value();
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws \ReflectionException
     */
    public function __call($name, $arguments)
    {
        foreach (static::toArray() as $key => $value) {
            $method = 'is' . Str::studly(Str::lower($key));
            if ($name === $method) {
                return $this->value() === $value;
            }
        }

        throw new \BadMethodCallException(sprintf('Method %s does not exists', $name));
    }

    /**
     * @param Enum $other
     * @return bool
     */
    public function equalsTo(Enum $other): bool
    {
        return get_class($other) === static::class
            && $other->value() === $this->value()
            && $other->key() === $this->key();
    }

    /**
     * @return string
     */
    public function key(): string
    {
        return $this->key;
    }
}
