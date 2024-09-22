<?php

namespace App\Models;

use App\Casts\EncryptedUserVehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserVehicle extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'uuid',
        'user_id',
        'data',
    ];

    protected function casts(): array
    {
        return [
            'data' => EncryptedUserVehicle::class,
            'uuid' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
