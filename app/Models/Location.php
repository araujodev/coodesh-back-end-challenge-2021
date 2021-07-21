<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Location
 * @package App\Models
 *
 * @property string $street_name
 * @property string $street_number
 * @property string $city
 * @property string $state
 * @property string $country
 * @property int $postcode
 * @property string $coordinates_latitude
 * @property string $coordinates_longitude
 * @property string $timezone_offset
 * @property string $timezone_description
 * @property int $user_id
 *
 */
class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_name',
        'street_number',
        'city',
        'state',
        'country',
        'postcode',
        'coordinates_latitude',
        'coordinates_longitude',
        'timezone_offset',
        'timezone_description',
        'user_id'
    ];

    protected $casts = [
        'postcode' => 'int'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
