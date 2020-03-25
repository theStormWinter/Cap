<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


use theStormWinter\CAP\Cap;


class AwarenessLevel
{
    /** @var string */
    public $raw;
    /** @var int */
    public $level;
    /** @var string */
    public $color;
    /** @var string */
    public $severity;

    public static function createInstance(string $awarenessLevel): AwarenessLevel
    {
        $ret = new self;
        $ret->raw = $awarenessLevel;
        [$level, $color, $severity] = explode(';', $awarenessLevel);
        $ret->level = (int)Cap::trimString($level);
        $ret->color = Cap::trimString($color);
        $ret->severity = Cap::trimString($severity);

        return $ret;
    }
}