<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


use DateTime;
use SimpleXMLElement;
use theStormWinter\CAP\Cap;


class Info
{
    /** @var string */
    public $language;
    /** @var string[] */
    public $categories;
    /** @var string */
    public $event;
    /** @var ResponseType[] */
    public $responseTypes;
    /** @var Urgency */
    public $urgency;
    /** @var Severity */
    public $severity;
    /** @var Certainty */
    public $certainty;
    /** @var string[] */
    public $audiences;
    /** @var EventCode[] */
    public $eventCodes;
    /** @var DateTime|null */
    public $effective;
    /** @var DateTime */
    public $onset;
    /** @var DateTime|null */
    public $expires;
    /** @var SenderName */
    public $senderName;
    /** @var string|null */
    public $headline;
    /** @var string|null */
    public $description;
    /** @var string|null */
    public $instruction;
    /** @var string */
    public $web;
    /** @var string|null */
    public $contact;
    /** @var Parameter[] */
    public $parameters;
    /** @var string|null */
    public $situation;
    /** @var string|null */
    public $criterion;
    /** @var DateTime|null */
    public $eventEndingTime;
    /** @var FloodWatch[] */
    public $floodWatches;
    /** @var FloodWatch[] */
    public $floodWarnings;
    /** @var FloodWatch[] */
    public $floodings;
    /** @var string|null */
    public $hydroOutlook;
    /** @var DateTime|null */
    public $expectedDecreaseToday;
    /** @var bool|null */
    public $expectedExceedingTomorrow;
    /** @var AwarenessLevel|null */
    public $awarenessLevel;
    /** @var AwarenessType|null */
    public $awarenessType;
    /** @var ResourceType[] */
    public $resources;
    /** @var Area[] */
    public $areas;

    public static function createInstance(SimpleXMLElement $simpleXMLElement): Info
    {
        $ret = new self;
        if (isset($simpleXMLElement->language)) {
            $ret->language = Cap::getNullIfEmpty((string)$simpleXMLElement->language);
        }
        self::setCategories($simpleXMLElement, $ret);
        if (isset($simpleXMLElement->event)) {
            $ret->event = Cap::getNullIfEmpty((string)$simpleXMLElement->event);
        }
        self::setResponseTypes($simpleXMLElement, $ret);
        if (isset($simpleXMLElement->urgency)) {
            $urgency = Cap::getNullIfEmpty((string)$simpleXMLElement->urgency);
            if (is_null($urgency) === false) {
                $ret->urgency = Urgency::createInstance($urgency);
            }
        }
        if (isset($simpleXMLElement->severity)) {
            $severity = Cap::getNullIfEmpty((string)$simpleXMLElement->severity);
            if (is_null($severity) === false) {
                $ret->severity = Severity::createInstance($severity);
            }
        }
        if (isset($simpleXMLElement->certainty)) {
            $certainty = Cap::getNullIfEmpty((string)$simpleXMLElement->certainty);
            if (is_null($certainty) === false) {
                $ret->certainty = Certainty::createInstance($certainty);
            }
        }
        $ret->audiences = [];
        if (isset($simpleXMLElement->audience)) {
            $ret->audiences = self::explodeAudience((string)$simpleXMLElement->audience);
        }
        self::setEventCodes($simpleXMLElement, $ret);
        if (isset($simpleXMLElement->effective)) {
            $effective = Cap::getNullIfEmpty((string)$simpleXMLElement->effective);
            if (is_null($effective) === false) {
                $ret->effective = new DateTime($effective);
            }
            $ret->effective = new DateTime((string)$simpleXMLElement->effective);
        }
        if (isset($simpleXMLElement->onset)) {
            $onset = Cap::getNullIfEmpty((string)$simpleXMLElement->onset);
            if (is_null($onset) === false) {
                $ret->onset = new DateTime($onset);
            }
        }
        if (isset($simpleXMLElement->expires)) {
            $expires = Cap::getNullIfEmpty((string)$simpleXMLElement->expires);
            if (is_null($expires) === false) {
                $ret->expires = new DateTime($expires);
            }
        }
        if (isset($simpleXMLElement->senderName)) {
            $senderName = Cap::getNullIfEmpty((string)$simpleXMLElement->senderName);
            if (is_null($senderName) === false) {
                $ret->senderName = SenderName::createInstance($senderName);
            }
        }
        if (isset($simpleXMLElement->headline)) {
            $ret->headline = Cap::getNullIfEmpty((string)$simpleXMLElement->headline);
        }
        if (isset($simpleXMLElement->description)) {
            $ret->description = Cap::getNullIfEmpty((string)$simpleXMLElement->description);
        }
        if (isset($simpleXMLElement->instruction)) {
            $ret->instruction = Cap::getNullIfEmpty((string)$simpleXMLElement->instruction);
        }
        if (isset($simpleXMLElement->web)) {
            $ret->web = Cap::getNullIfEmpty((string)$simpleXMLElement->web);
        }
        if (isset($simpleXMLElement->contact)) {
            $ret->contact = Cap::getNullIfEmpty((string)$simpleXMLElement->contact);
        }
        self::setParameters($simpleXMLElement, $ret);
        if (isset($simpleXMLElement->situation)) {
            $ret->situation = Cap::getNullIfEmpty((string)$simpleXMLElement->situation->value);
        }
        if (isset($simpleXMLElement->criterion)) {
            $ret->criterion = Cap::getNullIfEmpty((string)$simpleXMLElement->criterion->value);
        }
        if (isset($simpleXMLElement->eventEndingTime)) {
            $eventEndingTime = Cap::getNullIfEmpty((string)$simpleXMLElement->eventEndingTime);
            if (is_null($eventEndingTime) === false) {
                $ret->eventEndingTime = new DateTime($eventEndingTime);
            }
        }
        self::setFloodWatches($simpleXMLElement, $ret);
        self::setFloodWarnings($simpleXMLElement, $ret);
        self::setFloodings($simpleXMLElement, $ret);
        if (isset($simpleXMLElement->hydroOutlook)) {
            $ret->hydroOutlook = Cap::getNullIfEmpty((string)$simpleXMLElement->hydroOutlook->value);
        }
        if (isset($simpleXMLElement->expectedDecreaseToday)) {
            $expectedDecreaseToday = Cap::getNullIfEmpty((string)$simpleXMLElement->expectedDecreaseToday->value);
            if (is_null($expectedDecreaseToday) === false) {
                $ret->expectedDecreaseToday = new DateTime($expectedDecreaseToday);
            }
        }
        if (isset($simpleXMLElement->expectedExceedingTomorrow)) {
            $ret->expectedExceedingTomorrow = (bool)$simpleXMLElement->expectedExceedingTomorrow->value;
        }
        self::setAwarenessLevel($simpleXMLElement, $ret);
        self::setAwarenessType($simpleXMLElement, $ret);
        self::setResources($simpleXMLElement, $ret);
        self::setAreas($simpleXMLElement, $ret);


        return $ret;
    }

    public static function explodeAudience(string $audience): array
    {
        $arr = explode(',', $audience);
        foreach ($arr as $key => $item) {
            $arr[$key] = Cap::trimString($item);
        }

        return $arr;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setAreas(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        $items = [];
        if (isset($simpleXMLElement->area)) {
            /** @var SimpleXMLElement $area */
            foreach ($simpleXMLElement->area as $area) {
                $polygon = isset($area->polygon) ? $area->polygon : null;
                $altitude = isset($area->altitude) ? $area->altitude : null;
                $ceiling = isset($area->ceiling) ? $area->ceiling : null;
                $areaDesc = isset($area->areaDesc) ? $area->areaDesc : null;
                $geoCodes = isset($area->geocode) ? $area->geocode : null;
                $items[] = Area::createInstance((string)$areaDesc, $geoCodes, (string)$polygon, (string)$altitude, (string)$ceiling);
            }
        }
        $ret->areas = $items;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setAwarenessLevel(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        if (isset($simpleXMLElement->awareness_level)) {
            $ret->awarenessLevel = AwarenessLevel::createInstance((string)$simpleXMLElement->awareness_level->value);
        }
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setAwarenessType(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        if (isset($simpleXMLElement->awareness_type)) {
            $ret->awarenessType = AwarenessType::createInstance((string)$simpleXMLElement->awareness_type->value);
        }
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setCategories(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        $items = [];
        if (isset($simpleXMLElement->category)) {
            foreach ($simpleXMLElement->category as $category) {
                $category = Cap::getNullIfEmpty((string)$category);
                if (is_null($category)) {
                    continue;
                }
                $items[] = $category;
            }
        }
        $ret->categories = $items;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setEventCodes(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        $items = [];
        if (isset($simpleXMLElement->eventCode)) {
            /** @var SimpleXMLElement $eventCode */
            foreach ($simpleXMLElement->eventCode as $eventCode) {
                $valueName = isset($eventCode->valueName) ? Cap::getNullIfEmpty((string)$eventCode->valueName) : null;
                $value = isset($eventCode->value) ? Cap::getNullIfEmpty((string)$eventCode->value) : null;
                if (isset($valueName) || isset($value)) {
                    $items[] = EventCode::createInstance($valueName, $value);
                }
            }
        }
        $ret->eventCodes = $items;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setFloodWarnings(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        $items = [];
        if (isset($simpleXMLElement->floodWarning)) {
            /** @var SimpleXMLElement $floodWarning */
            foreach ($simpleXMLElement->floodWarning as $floodWarning) {
                $value = isset($floodWarning->value) ? Cap::getNullIfEmpty((string)$floodWarning->value) : null;
                if (isset($value)) {
                    $items[] = FloodWatch::createInstance($value);
                }
            }
        }
        $ret->floodWarnings = $items;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setFloodWatches(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        $items = [];
        if (isset($simpleXMLElement->floodWatch)) {
            /** @var SimpleXMLElement $floodWatch */
            foreach ($simpleXMLElement->floodWatch as $floodWatch) {
                $value = isset($floodWatch->value) ? Cap::getNullIfEmpty((string)$floodWatch->value) : null;
                if (isset($value)) {
                    $items[] = FloodWatch::createInstance($value);
                }
            }
        }
        $ret->floodWatches = $items;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setFloodings(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        $items = [];
        if (isset($simpleXMLElement->flooding)) {
            /** @var array $flooding */
            foreach ($simpleXMLElement->flooding as $flooding) {
                $value = isset($flooding->value) ? Cap::getNullIfEmpty((string)$flooding->value) : null;
                if (isset($value)) {
                    $items[] = FloodWatch::createInstance($value);
                }
            }
        }
        $ret->floodings = $items;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setParameters(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        $items = [];
        if (isset($simpleXMLElement->parameter)) {
            /** @var SimpleXMLElement $parameter */
            foreach ($simpleXMLElement->parameter as $parameter) {
                $valueName = isset($parameter->valueName) ? Cap::getNullIfEmpty((string)$parameter->valueName) : null;
                $value = isset($parameter->value) ? Cap::getNullIfEmpty((string)$parameter->value) : null;
                if (isset($valueName) || isset($value)) {
                    $items[] = Parameter::createInstance($valueName, $value);
                }
            }
        }
        $ret->parameters = $items;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setResources(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        $items = [];
        if (isset($simpleXMLElement->resource)) {
            /** @var SimpleXMLElement $resource */
            foreach ($simpleXMLElement->resource as $resource) {
                $resDesc = isset($resource->resourceDesc) ? Cap::getNullIfEmpty((string)$resource->resourceDesc) : null;
                $resMime = isset($resource->mimeType) ? Cap::getNullIfEmpty((string)$resource->mimeType) : null;
                $resSize = isset($resource->size) ? Cap::getNullIfEmpty((string)$resource->size) : null;
                $resUri = isset($resource->uri) ? Cap::getNullIfEmpty((string)$resource->uri) : null;
                if (isset($resDesc) || isset($resMime) || isset($resSize) || isset($resUri)) {
                    $items[] = ResourceType::createInstance($resDesc, $resMime, $resSize, $resUri);
                }
            }
        }
        $ret->resources = $items;
    }

    /**
     * @param SimpleXMLElement $simpleXMLElement
     * @param Info             $ret
     */
    private static function setResponseTypes(SimpleXMLElement $simpleXMLElement, Info $ret): void
    {
        $items = [];
        if (isset($simpleXMLElement->responseType)) {
            /** @var string $responseType */
            foreach ($simpleXMLElement->responseType as $responseType) {
                $responseType = Cap::getNullIfEmpty((string)$responseType);
                if (isset($responseType)) {
                    $items[] = ResponseType::createInstance((string)$responseType);
                }
            }
        }
        $ret->responseTypes = $items;
    }


}