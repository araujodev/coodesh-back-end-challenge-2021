<?php


namespace App\Connection;


use GuzzleHttp\Client;

abstract class UserConnection implements UserConnectionInterface
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

}
