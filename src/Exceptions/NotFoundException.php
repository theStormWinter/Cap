<?php declare(strict_types=1);


namespace theStormWinter\CAP\Exceptions;


use Exception;
use Throwable;


class NotFoundException extends Exception
{
    public function __construct($message = "", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}