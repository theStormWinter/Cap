<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


use theStormWinter\CAP\Cap;


class AwarenessType
{
    /** @var string */
    public $raw;
    /** @var int */
    public $level;
    /** @var string */
    public $value;

    public static function createInstance(string $awarenessType): AwarenessType
    {
        $ret = new self;
        $ret->raw = $awarenessType;
        [$level, $value] = explode(';', $awarenessType);
        $ret->level = (int)Cap::trimString($level);
        $ret->value = Cap::trimString($value);

        return $ret;
    }
}