<?php


namespace App\Services;


use App\Connection\UserConnection;

class UserService
{
    private $connection;

    public function __construct(UserConnection $connection)
    {
        $this->connection = $connection;
    }

    public function import(): void
    {
        $dataset    = $this->connection->getUserList(1);
        $users      = collect(data_get($dataset, 'results', []));
        $infoDataset= data_get($dataset, 'info');

        if ($users->isEmpty()) {
            return;
        }

        dd($users);
    }

}
