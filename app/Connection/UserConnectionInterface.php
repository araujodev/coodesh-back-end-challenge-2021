<?php


namespace App\Connection;


use Illuminate\Support\Collection;

interface UserConnectionInterface
{
    public function getUserList(?int $limit): Collection;

}
