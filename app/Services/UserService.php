<?php


namespace App\Services;

use App\Connection\UserConnection;
use App\Exceptions\BuildExceptions;
use App\Exceptions\UserExceptions;
use App\Filters\UserFilter;
use App\Models\Access;
use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    private const MAX_ITEMS_PER_PAGE = 100;

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

    /**
     * @throws BuildExceptions
     */
    public function update(int $user_id, array $requestData): ?Model
    {
        try {
            /**
             * @var User $user
             */
            $user = User::findOrFail($user_id);

            $user->gender = data_get($requestData, 'gender', $user->gender);
            $user->status = data_get($requestData, 'status', $user->status);
            $user->title_name = data_get($requestData, 'title_name', $user->title_name);
            $user->save();

            return $user;
        } catch (\Exception $exception) {
            throw UserExceptions::notFound($exception->getMessage());
        }
    }

    public function remove(int $user_id): bool
    {
        return User::destroy($user_id) > 0;
    }

    /**
     * @throws BuildExceptions
     */
    public function getOne(int $user_id): ?Model
    {
        try {
            return User::with(['location', 'access'])->findOrFail($user_id);
        } catch (\Exception $exception) {
            throw UserExceptions::notFound($exception->getMessage());
        }
    }

    public function getPaginate(array $filters = []): LengthAwarePaginator
    {
        return (new UserFilter())
            ->apply($filters)
            ->getQuery()
            ->with(['location', 'access'])
            ->paginate(self::MAX_ITEMS_PER_PAGE);
    }

}
