<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


use SimpleXMLElement;
use theStormWinter\CAP\Cap;


class Area
{
    /** @var string */
    public $areaDesc;
    /** @var GeoCode[] */
    public $geocodes;
    /** @var string|null */
    public $polygon;
    /** @var string|null */
    public $altitude;
    /** @var string|null */
    public $ceiling;

    public static function createInstance(?string $areaDesc, ?SimpleXMLElement $geocodes, ?string $polygon = null, ?string $altitude = null, ?string $ceiling = null): Area
    {
        $ret = new self;
        $ret->areaDesc = Cap::getNullIfEmpty($areaDesc);
        $ret->polygon = Cap::getNullIfEmpty($polygon);
        $ret->altitude = Cap::getNullIfEmpty($altitude);
        $ret->ceiling = Cap::getNullIfEmpty($ceiling);
        $geos = [];
        foreach ($geocodes as $code) {
            $name = isset($code->valueName) ? Cap::getNullIfEmpty((string)$code->valueName) : null;
            $valueName = Cap::getNullIfEmpty($name);
            $value = isset($code->value) ? Cap::getNullIfEmpty((string)$code->value) : null;
            $val = Cap::getNullIfEmpty($value);
            if (isset($name) && isset($val)) {
                $geos[] = GeoCode::createInstance($valueName, $val);
            }
        }
        $ret->geocodes = $geos;

        return $ret;
    }
}