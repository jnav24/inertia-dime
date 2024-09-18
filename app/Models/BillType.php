<?php

namespace App\Models;

use App\Traits\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillType extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'name',
        'slug',
    ];

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
        ];
    }
}
