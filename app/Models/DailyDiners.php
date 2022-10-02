<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyDiners extends Model
{
    protected $table = 'daily_diners';
    protected $fillable = [
        'date',
        'user_id',
        'is_lunch',
        'rating',
        'food_id',
        'status_changed_at',
        'order',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'id' => 'integer',
        'order' => 'integer',
        'user_id' => 'integer',
        'date' => 'date',
        'is_lunch' => 'boolean',
        'rating' => 'integer',
        'status_changed_at' => 'datetime',
        'food_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
