<?php


namespace App\Connection;

use GuzzleHttp\Exception\GuzzleException;

class RandomUserConnection extends UserConnection implements UserConnectionInterface
{
    private const MAX_ITEMS_PER_PAGE = 100;

    public function __construct(RandomUserHttpClient $client)
    {
        parent::__construct($client);
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function getUserList(?int $page = 1): array
    {
        $response = $this->client->get(RandomUserRoutes::LIST_USERS, [
            'query' => [
                'results' => self::MAX_ITEMS_PER_PAGE,
                'page' => $page
            ]
        ]);
        return json_decode($response->getBody()->__toString(), true);
    }

}
