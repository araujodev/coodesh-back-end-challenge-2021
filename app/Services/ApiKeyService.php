<?php


namespace App\Services;


use App\Enumerators\AuthorizationStatusEnum;
use App\Models\Authorization;
use Illuminate\Database\Eloquent\Model;

class ApiKeyService
{

    public function generate(?string $client = ''): ?Model
    {
        try {
            $client = $this->getClient($client);

            $auth = new Authorization();
            $auth->status = AuthorizationStatusEnum::ACTIVE;
            $auth->sha1_value = sha1($client);
            $auth->key = Authorization::KEY_NAME;
            $auth->save();
            return $auth;
        } catch (\Exception $exception) {
            return null;
        }
    }

    private function getClient(?string $client = ''): string
    {
        if ($client == null){
            return uniqid();
        }
        return $client;
    }

    public function getOneByValue(string $value): ?Authorization
    {
        return Authorization::where('sha1_value', '=', $value)->first();
    }

}