<?php

namespace crmpbx\httpClient;

use JetBrains\PhpStorm\ArrayShape;

class Request extends \GuzzleHttp\Psr7\Request
{
    public function __construct($method, $uri, $body = null, $version = '1.1')
    {
        parent::__construct($method, $uri, $this->setHeaders(), $this->setBody($body), $version);
    }

    #[ArrayShape(['Content-Type' => "string", 'Accept' => "string"])] protected function setHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
    }

    protected function setBody($data): string
    {
        return (string)json_encode($data);
    }
}