<?php

namespace App\Services\Weather\Sources;

abstract class Source implements
    Contracts\IAdaptable,
    Contracts\IByCoordsRequestable,
    Contracts\IHTTPSupportable
{
    /**
     * @return string
     */
    abstract protected static function getBaseURL() : string;
}
