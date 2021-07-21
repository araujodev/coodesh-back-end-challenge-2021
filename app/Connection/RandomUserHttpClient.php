<?php


namespace App\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\ResponseInterface;

class RandomUserHttpClient extends Client
{
    private const RANDOM_USER_LOG = 'RANDOM_USER_LOG';

    private const REQUEST_SUFFIX = '_REQUEST';
    private const RESPONSE_SUFFIX = '_RESPONSE';

    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        try {

            Log::info(self::RANDOM_USER_LOG . self::REQUEST_SUFFIX, [
                'http_method' => $method,
                'uri' => $uri,
                'request_options' => $options
            ]);

            $response = parent::request($method, $uri, $options);

            Log::info(self::RANDOM_USER_LOG . self::RESPONSE_SUFFIX, [
                'http_method' => $method,
                'http_status_code' => $response->getStatusCode(),
                'uri' => $uri,
                'response' => $response->getBody()
            ]);

            return $response;

        } catch (ServerException $exception) {
            Log::error(self::RANDOM_USER_LOG . self::RESPONSE_SUFFIX, [
                'http_method' => $method,
                'uri' => $uri,
                'error' => $exception->getMessage()
            ]);
        }
    }

}
