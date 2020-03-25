<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


use DateTime;
use SimpleXMLElement;
use theStormWinter\CAP\Cap;


class Alert
{
    /** @var string */
    public $identifier;
    /** @var string */
    public $sender;
    /** @var DateTime */
    public $sent;
    /** @var string */
    public $status;
    /** @var string */
    public $msgType;
    /** @var string|null */
    public $source;
    /** @var string */
    public $scope;
    /** @var string|null */
    public $restriction;
    /** @var string[] */
    public $addresses;
    /** @var string[] */
    public $codes;
    /** @var string|null */
    public $note;
    /** @var Reference[] */
    public $references;
    /** @var string[] */
    public $incidents;
    /** @var Info[] */
    public $infos;

    public static function createInstance(SimpleXMLElement $simpleXMLElement): Alert
    {
        $ret = new self;
        if (isset($simpleXMLElement->identifier)) {
            $ret->identifier = Cap::getNullIfEmpty((string)$simpleXMLElement->identifier);
        }
        if (isset($simpleXMLElement->sender)) {
            $ret->sender = Cap::getNullIfEmpty((string)$simpleXMLElement->sender);
        }
        if (isset($simpleXMLElement->sent)) {
            $sent = Cap::getNullIfEmpty((string)$simpleXMLElement->sent);
            if (is_null($sent) === false) {
                $ret->sent = new DateTime($sent);
            }
        }
        if (isset($simpleXMLElement->status)) {
            $ret->status = Cap::getNullIfEmpty((string)$simpleXMLElement->status);
        }
        if (isset($simpleXMLElement->msgType)) {
            $ret->msgType = Cap::getNullIfEmpty((string)$simpleXMLElement->msgType);
        }
        if (isset($simpleXMLElement->source)) {
            $ret->source = Cap::getNullIfEmpty((string)$simpleXMLElement->source);
        }
        if (isset($simpleXMLElement->scope)) {
            $ret->scope = Cap::getNullIfEmpty((string)$simpleXMLElement->scope);
        }
        if (isset($simpleXMLElement->restriction)) {
            $ret->restriction = Cap::getNullIfEmpty((string)$simpleXMLElement->restriction);
        }
        $ret->addresses = [];
        if (isset($simpleXMLElement->addresses)) {
            $ret->addresses = self::explodeAdresses((string)$simpleXMLElement->addresses);
        }
        $items = [];
        if (isset($simpleXMLElement->code)) {
            /** @var string $code */
            foreach ($simpleXMLElement->code as $code) {
                $code = Cap::getNullIfEmpty((string)$code);
                if (is_null($code)) {
                    continue;
                }
                $items[] = (string)$code;
            }
        }
        $ret->codes = $items;
        if (isset($simpleXMLElement->note)) {
            $ret->note = Cap::getNullIfEmpty((string)$simpleXMLElement->note);
        }
        $items = [];
        if (isset($simpleXMLElement->references)) {
            /** @var string $reference */
            foreach ($simpleXMLElement->references as $reference) {
                $reference = Cap::getNullIfEmpty((string)$reference);
                if (is_null($reference)) {
                    continue;
                }
                $items[] = Reference::createInstance($reference);
            }
        }
        $ret->references = $items;
        $items = [];
        if (isset($simpleXMLElement->incidents)) {
            /** @var string $incident */
            foreach ($simpleXMLElement->incidents as $incident) {
                $incident = Cap::getNullIfEmpty((string)$incident);
                if (is_null($incident)) {
                    continue;
                }
                $items[] = $incident;
            }
        }
        $ret->incidents = $items;
        $items = [];
        if (isset($simpleXMLElement->info)) {
            /** @var SimpleXMLElement $info */
            foreach ($simpleXMLElement->info as $info) {
                $items[] = Info::createInstance($info);
            }
        }
        $ret->infos = $items;

        return $ret;
    }

    public static function explodeAdresses(string $adresses): array
    {
        return explode(' ', $adresses);
    }


}