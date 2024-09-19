<?php

namespace App\Models;

use App\Traits\HasUuids;
use App\Traits\WithExpenses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BudgetTemplate extends Model
{
    use SoftDeletes, HasFactory, HasUuids, WithExpenses;

    protected $fillable = [
        'uuid',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'uuid' => 'string',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
