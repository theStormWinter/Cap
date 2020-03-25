<?php declare(strict_types=1);


namespace theStormWinter\CAP\Types;


use theStormWinter\CAP\Cap;


class FloodWatch
{
    /** @var string */
    public $raw;
    /** @var string */
    public $flood;
    /** @var string */
    public $station;
    /** @var string */
    public $level;
    /** @var string */
    public $flow;
    /** @var string */
    public $tendency;

    public static function createInstance(string $floodWatch): FloodWatch
    {
        $ret = new self;
        $ret->raw = $floodWatch;
        [$flood, $station, $level, $flow, $tendency] = explode(',', $floodWatch);
        $ret->flood = Cap::trimString($flood);
        $ret->station = Cap::trimString($station);
        $ret->level = Cap::trimString($level);
        $ret->flow = Cap::trimString($flow);
        $ret->tendency = Cap::trimString($tendency);

        return $ret;
    }
}