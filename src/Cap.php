<?php declare(strict_types=1);


namespace theStormWinter\CAP;


use Curl\Curl;
use ErrorException;
use SimpleXMLElement;
use theStormWinter\CAP\Exceptions\NotFoundException;
use theStormWinter\CAP\Types\CapFile;
use UnexpectedValueException;


class Cap
{

    public static function getNullIfEmpty(?string $value): ?string
    {
        if (empty($value)) {
            return null;
        }

        return $value;
    }

    /**
     * @param string $url
     * @return CapFile
     * @throws ErrorException
     * @throws NotFoundException
     */
    public function read(string $url): CapFile
    {
        $curl = new Curl($url);
        $response = $curl->get($url);
        if ($curl->error == true) {
            if ($curl->errorCode == 404) {
                throw new NotFoundException(sprintf('File at url "%S" not found', $url));
            }
            if ($curl->errorCode == 6) {
                throw new NotFoundException(sprintf('Couldn\'t resolve host: "%S" not found', $url));
            }
        }
        if ($response instanceof SimpleXMLElement === false) {
            throw new UnexpectedValueException(sprintf('Bad response from url "%s"', $url));
        }
        return CapFile::createInstance($response);
    }

    public static function trimString(?string $value): ?string
    {
        if (empty($value) === false) {
            $value = trim($value);
        }

        return $value;
    }
}