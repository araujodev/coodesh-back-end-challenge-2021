<?php


namespace App\Adapters\RandomUserImplementation;


use App\Enumerators\UserStatusEnum;
use App\Models\Access;
use App\Models\Location;
use App\Models\User;

class UserAdapter
{
    private $originalData;

    /**
     * UserAdapter constructor.
     * @param mixed $userData
     */
    public function __construct(array $userData)
    {
        $this->originalData = $userData;
        return $this;
    }

    public function build(): array
    {
        $user = new User();
        $user->id_name        = data_get($this->originalData, 'id.name');
        $user->id_value       = data_get($this->originalData, 'id.value');
        $user->title_name     = data_get($this->originalData, 'name.title');
        $user->first_name      = data_get($this->originalData, 'name.first');
        $user->last_name      = data_get($this->originalData, 'name.last');
        $user->gender         = data_get($this->originalData, 'gender');
        $user->email          = data_get($this->originalData, 'email');
        $user->dob_date       = data_get($this->originalData, 'dob.date');
        $user->dob_age        = data_get($this->originalData, 'dob.age');
        $user->registered_date= data_get($this->originalData, 'registered.date');
        $user->registered_age = data_get($this->originalData, 'registered.age');
        $user->phone = data_get($this->originalData, 'phone');
        $user->cell = data_get($this->originalData, 'cell');
        $user->nat = data_get($this->originalData, 'nat');
        $user->large_picture = data_get($this->originalData, 'picture.large');
        $user->medium_picture = data_get($this->originalData, 'picture.medium');
        $user->thumbnail_picture = data_get($this->originalData, 'picture.thumbnail');
        $user->status = UserStatusEnum::PUBLISHED;
        $user->imported_t = now()->format('Y-m-d H:i:s');

        $location = new Location();
        $location->street_name = data_get($this->originalData, 'location.street.name');
        $location->street_number = data_get($this->originalData, 'location.street.number');
        $location->city = data_get($this->originalData, 'location.city');
        $location->state = data_get($this->originalData, 'location.state');
        $location->country = data_get($this->originalData, 'location.country');
        $location->postcode = data_get($this->originalData, 'location.postcode');
        $location->coordinates_latitude = data_get($this->originalData, 'location.coordinates.latitude');
        $location->coordinates_longitude = data_get($this->originalData, 'location.coordinates.longitude');
        $location->timezone_offset = data_get($this->originalData, 'location.timezone.offset');
        $location->timezone_description = data_get($this->originalData, 'location.timezone.description');

        $access = new Access();
        $access->uuid = data_get($this->originalData, 'login.uuid');
        $access->username = data_get($this->originalData, 'login.username');
        $access->password = data_get($this->originalData, 'login.password');
        $access->salt = data_get($this->originalData, 'login.salt');
        $access->md5 = data_get($this->originalData, 'login.md5');
        $access->sha1 = data_get($this->originalData, 'login.sha1');
        $access->sha256 = data_get($this->originalData, 'login.sha256');

        return [$user, $location, $access];
    }
}
