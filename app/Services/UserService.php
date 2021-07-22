<?php


namespace App\Services;


use App\Connection\UserConnection;
use App\Models\Access;
use App\Models\Location;
use App\Models\User;

class UserService
{
    private $connection;

    public function __construct(UserConnection $connection)
    {
        $this->connection = $connection;
    }

    public function import(): void
    {
        $list = $this->connection->getUserList(2000);

        if ($list->isEmpty()) {
            return;
        }

        $list->map(function(array $mapping){
            $user = data_get($mapping, 'user', new User());
            if ($user->save()) {
                $user->access()->save(data_get($mapping, 'access', new Access()));
                $user->location()->save(data_get($mapping, 'location', new Location()));
            }
        });
    }

}
