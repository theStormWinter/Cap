<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


use DateTime;


/**
 * Class Parameter
 * @package theStormWinter\CAP\Types
 * @property AwarenessLevel $awarenessLevel
 */
class Parameter
{
    /** @var string */
    public $valueName;
    /** @var string|AwarenessLevel|AwarenessType|DateTime */
    public $value;

    public static function createInstance(?string $valueName, ?string $value): Parameter
    {
        $ret = new self;
        if ($valueName == 'eventEndingTime') {
            if (is_null($value) === false) {
                $ret->valueName = $valueName;
                $ret->value = new DateTime($value);
            }

            return $ret;
        }
        if ($valueName == 'awareness_level') {
            if (is_null($value) === false) {
                $ret->valueName = $valueName;
                $ret->value = self::setAwarenessLevel($value);
            }

            return $ret;
        }
        if ($valueName == 'awareness_type') {
            if (is_null($value) === false) {
                $ret->valueName = $valueName;
                $ret->value = self::setAwarenessType($value);
            }

            return $ret;
        }
        $ret->valueName = $valueName;
        $ret->value = $value;

        return $ret;
    }

    /**
     * @param string $item
     * @return AwarenessLevel
     */
    private static function setAwarenessLevel(string $item): AwarenessLevel
    {
        return AwarenessLevel::createInstance($item);
    }

    /**
     * @param string $item
     * @return AwarenessType
     */
    private static function setAwarenessType(string $item): AwarenessType
    {
        return AwarenessType::createInstance($item);
    }

}