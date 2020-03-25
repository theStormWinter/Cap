<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


use DateTime;


class EventEndingTime
{
    /** @var string */
    public $valueName;
    /** @var DateTime */
    public $value;

    public static function createInstance(string $valueName, string $value): EventEndingTime
    {
        $ret = new self;
        $ret->valueName = $valueName;
        $ret->value = new DateTime($value);

        return $ret;
    }
}