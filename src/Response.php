<?php


namespace crmpbx\httpClient;

use Psr\Http\Message\ResponseInterface;


class Response
{
    public int $status;
    public array $headers;
    public mixed $body;
    public string $reason;
    public array $timer;


    public function __construct(ResponseInterface $response, array $timer)
    {
        $this->timer = $timer;
        $this->init($response);
    }

    private function init(ResponseInterface $response)
    {
        $this->status = $response->getStatusCode();
        $this->headers = $response->getHeaders();
        if($content = json_decode($response->getBody()->getContents(), true))
            $this->body = $content;
        else
            $this->body = $response->getBody()->getContents();
        $this->reason = $response->getReasonPhrase();
    }
}