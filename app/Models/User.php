<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 * @package App\Models
 *
 * @property string $id_name
 * @property string $id_value
 * @property string $title_name
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $email
 * @property \DateInterval $dob_date
 * @property int $dob_age
 * @property \DateInterval $registered_date
 * @property int $registered_age
 * @property string $phone
 * @property string $cell
 * @property string $nat
 * @property string $large_picture
 * @property string $medium_picture
 * @property string $thumbnail_picture
 * @property \DateInterval $imported_t
 * @property string $status
 */
class User extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_name',
        'id_value',
        'title_name',
        'first_name',
        'last_name',
        'gender',
        'email',
        'dob_date',
        'dob_age',
        'registered_date',
        'registered_age',
        'phone',
        'cell',
        'nat',
        'large_picture',
        'medium_picture',
        'thumbnail_picture',
        'status',
        'imported_t'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'imported_t' => 'datetime',
        'dob_date' => 'datetime',
        'registered_date' => 'datetime'
    ];

    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }

    public function access(): HasOne
    {
        return $this->hasOne(Access::class);
    }
}
