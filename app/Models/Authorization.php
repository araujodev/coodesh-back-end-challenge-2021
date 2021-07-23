<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Authorization
 * @package App\Models
 *
 * @property string $key
 * @property string $sha1_value
 * @property string $status
 */
class Authorization extends Model
{
    use HasFactory;

    public const KEY_NAME = 'integrator';

    public $timestamps = false;

    protected $fillable = [
        'key',
        'sha1_value',
        'status'
    ];
}
