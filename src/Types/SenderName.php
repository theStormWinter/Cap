<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


use theStormWinter\CAP\Cap;


class SenderName
{
    /** @var string */
    public $raw;
    /** @var string */
    public $organization;
    /** @var string|null */
    public $author;

    public static function createInstance(string $senderName): SenderName
    {
        $organization = null;
        $author = null;
        $ret = new self;
        $ret->raw = $senderName;
        $arr = explode(',', $senderName);
        $ret->organization = Cap::trimString($arr[0]);
        if (isset($arr[1])) {
            $ret->author = Cap::trimString($arr[1]);
        }

        return $ret;
    }
}