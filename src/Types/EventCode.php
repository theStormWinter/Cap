<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


class EventCode
{
    /** @var string */
    public $valueName;
    /** @var string */
    public $value;

    public static function createInstance(string $valueName, string $value): EventCode
    {
        $item = new self;
        $item->valueName = $valueName;
        $item->value = $value;

        return $item;
    }
}