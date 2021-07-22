<?php


namespace App\Connection\RandomUserImplementation;

use App\Adapters\RandomUserImplementation\UserAdapter;
use App\Connection\UserConnection;
use App\Connection\UserConnectionInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;

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
    public function getUserList(?int $limit = 2000): Collection
    {
        $lastPage = (int) $limit / self::MAX_ITEMS_PER_PAGE;
        $userList = collect([]);

        for ($index = 1; $index <= $lastPage; $index++) {

            $response = $this->client->get(RandomUserRoutes::LIST_USERS, [
                'query' => [
                    'results' => self::MAX_ITEMS_PER_PAGE,
                    'page' => $index
                ]
            ]);

            $dataset = json_decode($response->getBody()->__toString(), true);
            $userResults = data_get($dataset, 'results', []);

            foreach ($userResults as $userData) {

                list($user, $location, $access) = (new UserAdapter($userData))->build();

                $userList->push([
                    'user' => $user,
                    'location' => $location,
                    'access' => $access
                ]);
            }

        }

        return $userList;
    }

}
