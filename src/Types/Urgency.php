<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


class Urgency
{
    const IMMEDIATE = 4;
    const EXPECTED = 3;
    const FUTURE = 2;
    const PAST = 1;
    const UNKNOWN = 0;

    /** @var string */
    public $value;
    /** @var int|null */
    public $level;

    public static function createInstance(string $urgency): Urgency
    {
        $item = new self;
        $item->value = $urgency;
        $item->level = constant('self::'.strtoupper($urgency));

        return $item;
    }
}