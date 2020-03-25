<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


class Severity
{
    const EXTREME = 4;
    const SEVERE = 3;
    const MODERATE = 2;
    const MINOR = 1;
    const UNKNOWN = 0;

    /** @var string */
    public $value;
    /** @var int|null */
    public $level;

    public static function createInstance(string $severity): Severity
    {
        $item = new self;
        $item->value = $severity;
        $item->level = constant('self::'.strtoupper($severity));

        return $item;
    }
}