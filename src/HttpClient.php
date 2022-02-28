<?php

namespace crmpbx\httpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\RequestInterface;

class HttpClient extends Client
{
    public function getResponse(RequestInterface $request, int $timeout = null): Response
    {
        $timer = new Timer(microtime(true));

        try {
            $response = $this->send($request, [
                'timeout' => $timeout ?? 2,
                'http_errors' => false
            ]);
        } catch (ClientException $e) {
            $response = $e->getResponse();
        }

        return new Response($response, $timer->getStampForCurrentTime(microtime(true)));
    }
}
