<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


class ResourceType
{
    /** @var string */
    public $resourceDesc;
    /** @var string */
    public $mimeType;
    /** @var int */
    public $size;
    /** @var string */
    public $uri;

    public static function createInstance(?string $resourceDesc, ?string $mimeType, ?string $size, ?string $uri): ResourceType
    {
        $ret = new self;
        $ret->resourceDesc = $resourceDesc;
        $ret->mimeType = $mimeType;
        $ret->size = (int)$size;
        $ret->uri = $uri;

        return $ret;
    }
}