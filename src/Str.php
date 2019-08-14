<?php

namespace Morilog\PhpEnum;

final class Str
{
    private static $studlyCache = [];

    private static $camelCache = [];

    public static function studly(string $value): string
    {
        $key = $value;
        if (isset(static::$studlyCache[$key])) {
            return static::$studlyCache[$key];
        }
        $value = ucwords(str_replace(['-', '_'], ' ', $value));
        return static::$studlyCache[$key] = str_replace(' ', '', $value);
    }

    public static function lower(string $value): string
    {
        return mb_strtolower($value);
    }

    public static function camel($value)
    {
        if (isset(static::$camelCache[$value])) {
            return static::$camelCache[$value];
        }
        return static::$camelCache[$value] = lcfirst(static::studly($value));
    }
}
