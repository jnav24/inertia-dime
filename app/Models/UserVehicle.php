<?php

namespace App\Models;

use App\Casts\EncryptedUserVehicle;
use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserVehicle extends Model
{
    use SoftDeletes, HasFactory, HasUuids;

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

    public function vehicle(): HasOne
    {
        return $this->hasOne(Vehicle::class, 'user_vehicle_id', 'uuid');
    }
}
