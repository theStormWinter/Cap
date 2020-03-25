<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


use DateTime;
use theStormWinter\CAP\Cap;


class Reference
{
    /** @var string */
    public $raw;
    /** @var string */
    public $identifier;
    /** @var string */
    public $sender;
    /** @var DateTime */
    public $sent;

    public static function createInstance(string $raw): Reference
    {
        $item = new self;
        $item->raw = $raw;
        [$sender, $identifier, $sent] = explode(',', $raw, 3);
        $item->identifier = Cap::trimString($identifier);
        $item->sender = Cap::trimString($sender);
        $item->sent = new DateTime(Cap::trimString($sent));

        return $item;

    }
}