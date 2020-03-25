<?php

namespace theStormWinter\CAP\Tests;

use DateTime;
use Tester\Assert;
use Tester\TestCase;
use theStormWinter\CAP\Cap;
use theStormWinter\CAP\Exceptions\NotFoundException;
use theStormWinter\CAP\Types\Alert;
use theStormWinter\CAP\Types\Area;
use theStormWinter\CAP\Types\AwarenessLevel;
use theStormWinter\CAP\Types\AwarenessType;
use theStormWinter\CAP\Types\CapFile;
use theStormWinter\CAP\Types\Certainty;
use theStormWinter\CAP\Types\EventCode;
use theStormWinter\CAP\Types\FloodWatch;
use theStormWinter\CAP\Types\GeoCode;
use theStormWinter\CAP\Types\Info;
use theStormWinter\CAP\Types\Parameter;
use theStormWinter\CAP\Types\Reference;
use theStormWinter\CAP\Types\ResourceType;
use theStormWinter\CAP\Types\ResponseType;
use theStormWinter\CAP\Types\SenderName;
use theStormWinter\CAP\Types\Severity;
use theStormWinter\CAP\Types\Urgency;


include __DIR__.'/../vendor/autoload.php';

/**
 * Class CapTest
 * @package theStormWinter\CAP\Tests
 * @testCase
 */
class CapTest extends TestCase
{

    public function testRead()
    {
        $badUrl = 'http://portal.chmi.cz/files/portal/docs/meteo/om/bulletiny/bad.xml';
        Assert::exception(function() use ($badUrl) {
            $service = new Cap;
            $service->read($badUrl);
        }, NotFoundException::class);

        $badUrl2 = 'http://example-bad-url.com/bad.xml';
        Assert::exception(function() use ($badUrl2) {
            $service = new Cap;
            $service->read($badUrl2);
        }, NotFoundException::class);

        $url = 'http://portal.chmi.cz/files/portal/docs/meteo/om/bulletiny/XOCZ50_OKPR.xml';
        $service = new Cap;
        $item = $service->read($url);
        Assert::type(CapFile::class, $item);
        Assert::type(Alert::class, $item->alert);
        Assert::type('string', $item->alert->identifier);
        Assert::type('string', $item->alert->sender);
        Assert::type(DateTime::class, $item->alert->sent);
        Assert::type('string', $item->alert->status);
        Assert::type('string', $item->alert->msgType);
        if (isset($item->alert->source)) {
            Assert::type('string', $item->alert->source);
        }
        Assert::type('string', $item->alert->scope);
        if (isset($item->alert->restriction)) {
            Assert::type('string', $item->alert->restriction);
        }
        Assert::type('array', $item->alert->addresses);
        foreach ($item->alert->addresses as $address) {
            Assert::type('string', $address);
        }
        Assert::type('array', $item->alert->codes);
        foreach ($item->alert->codes as $code) {
            Assert::type('string', $code);
        }
        if (isset($item->alert->note)) {
            Assert::type('string', $item->alert->note);
        }
        Assert::type('array', $item->alert->references);
        foreach ($item->alert->references as $reference) {
            Assert::type(Reference::class, $reference);
            Assert::type('string', $reference->sender);
            Assert::type('string', $reference->identifier);
            Assert::type(DateTime::class, $reference->sent);
        }
        Assert::type('array', $item->alert->incidents);
        foreach ($item->alert->incidents as $incident) {
            Assert::type('string', $incident);
        }
        Assert::type('array', $item->alert->infos);
        foreach ($item->alert->infos as $info) {
            Assert::type(Info::class, $info);
            Assert::type('string', $info->language);
            Assert::type('array', $info->categories);
            foreach ($info->categories as $category) {
                Assert::type('string', $category);
            }
            Assert::type('string', $info->event);
            Assert::type('array', $info->responseTypes);
            foreach ($info->responseTypes as $responseType) {
                Assert::type(ResponseType::class, $responseType);
                Assert::type('string', $responseType->value);
                Assert::type('int', $responseType->level);
            }
            Assert::type(Urgency::class, $info->urgency);
            Assert::type(Severity::class, $info->severity);
            Assert::type(Certainty::class, $info->certainty);
            Assert::type('array', $info->audiences);
            foreach ($info->audiences as $audience) {
                Assert::type('string', $audience);
            }
            Assert::type('array', $info->eventCodes);
            foreach ($info->eventCodes as $eventCode) {
                Assert::type(EventCode::class, $eventCode);
                Assert::type('string', $eventCode->valueName);
                Assert::type('string', $eventCode->value);
            }
            if (isset($info->effective)) {
                Assert::type(DateTime::class, $info->effective);
            }
            Assert::type(DateTime::class, $info->onset);
            if (isset($info->expires)) {
                Assert::type(DateTime::class, $info->expires);
            }
            Assert::type(SenderName::class, $info->senderName);
            Assert::type('string', $info->senderName->organization);
            if (isset($info->headline)) {
                Assert::type('string', $info->headline);
            }
            if (isset($info->description)) {
                Assert::type('string', $info->description);
            }
            if (isset($info->instruction)) {
                Assert::type('string', $info->instruction);
            }

            Assert::type('string', $info->web);
            if (isset($info->contact)) {
                Assert::type('string', $info->contact);
            }
            Assert::type('array', $info->parameters);
            foreach ($info->parameters as $parameter) {
                Assert::type(Parameter::class, $parameter);
                Assert::type('string', $parameter->valueName);
            }
            if (isset($info->situation)) {
                Assert::type('string', $info->situation);
            }
            if (isset($info->criterion)) {
                Assert::type('string', $info->criterion);
            }
            if (isset($info->eventEndingTime)) {
                Assert::type(DateTime::class, $info->eventEndingTime);
            }
            Assert::type('array', $info->floodWatches);
            foreach ($info->floodWatches as $floodWatch) {
                Assert::type(FloodWatch::class, $floodWatch);
                Assert::type('string', $floodWatch->tendency);
            }
            Assert::type('array', $info->floodWarnings);
            foreach ($info->floodWarnings as $floodWarning) {
                Assert::type(FloodWatch::class, $floodWarning);
                Assert::type('string', $floodWarning->tendency);
            }
            Assert::type('array', $info->floodings);
            foreach ($info->floodings as $flooding) {
                Assert::type(FloodWatch::class, $flooding);
                Assert::type('string', $flooding->tendency);
            }
            if (isset($info->hydroOutlook)) {
                Assert::type('string', $info->hydroOutlook);
            }
            if (isset($info->expectedDecreaseToday)) {
                Assert::type(DateTime::class, $info->expectedDecreaseToday);
            }
            if (isset($info->expectedExceedingTomorrow)) {
                Assert::type('bool', $info->expectedExceedingTomorrow);
            }
            if (isset($info->awarenessLevel)) {
                Assert::type(AwarenessLevel::class, $info->awarenessLevel);
            }
            if (isset($info->awarenessType)) {
                Assert::type(AwarenessType::class, $info->awarenessType);
            }
            Assert::type('array', $info->resources);
            foreach ($info->resources as $resource) {
                Assert::type(ResourceType::class, $resource);
                Assert::type('string', $resource->uri);
                Assert::type('string', $resource->size);
                Assert::type('string', $resource->mimeType);
                Assert::type('string', $resource->resourceDesc);
            }
            Assert::type('array', $info->areas);
            foreach ($info->areas as $area) {
                Assert::type(Area::class, $area);
                Assert::type('string', $area->areaDesc);
                Assert::type('array', $area->geocodes);
                foreach ($area->geocodes as $geocode) {
                    Assert::type(GeoCode::class, $geocode);
                }
                if (isset($area->polygon)) {
                    Assert::type('string', $area->polygon);
                }
                if (isset($area->altitude)) {
                    Assert::type('string', $area->altitude);
                }
                if (isset($area->ceiling)) {
                    Assert::type('string', $area->ceiling);
                }
            }
        }
    }
}

(new CapTest)->run();
