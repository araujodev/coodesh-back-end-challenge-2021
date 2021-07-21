<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Access
 * @package App\Models
 *
 * @property string $uuid
 * @property string $username
 * @property string $password
 * @property string $salt
 * @property string $md5
 * @property string $sha1
 * @property string $sha256
 * @property int $user_id
 */
class Access extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'username',
        'password',
        'salt',
        'md5',
        'sha1',
        'sha256',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
