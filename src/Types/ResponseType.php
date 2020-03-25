<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


class ResponseType
{
    const SHELTER = 8;
    const EVACUATE = 7;
    const PREPARE = 6;
    const EXECUTE = 5;
    const AVOID = 4;
    const MONITOR = 3;
    const ASSESS = 2;
    const ALL_CLEAR = 1;
    const NONE = 0;

    /** @var string */
    public $value;
    /** @var int|null */
    public $level;

    public static function createInstance(string $responseType): ResponseType
    {
        $item = new self;
        $item->value = $responseType;
        $item->level = constant('self::'.strtoupper($responseType));

        return $item;
    }

}