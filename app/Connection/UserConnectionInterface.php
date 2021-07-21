<?php


namespace App\Connection;


interface UserConnectionInterface
{
    public function getUserList(?int $page): array;

}
