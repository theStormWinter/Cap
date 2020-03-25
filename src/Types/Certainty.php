<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


class Certainty
{
    const OBSERVED = 4;
    const LIKELY = 3;
    const POSSIBLE = 2;
    const UNLIKELY = 1;
    const UNKNOWN = 0;

    /** @var string */
    public $value;
    /** @var int|null */
    public $level;

    public static function createInstance(string $certainty): Certainty
    {
        $item = new self;
        $item->value = $certainty;
        $item->level = constant('self::'.strtoupper($certainty));

        return $item;
    }
}