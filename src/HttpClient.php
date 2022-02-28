<?php

namespace crmpbx\httpClient;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
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
        } catch (GuzzleException $e) {
            $response = new \GuzzleHttp\Psr7\Response(500, [], $e->getMessage());
        }

        return new Response($response, $timer->getStampForCurrentTime(microtime(true)));
    }
}
