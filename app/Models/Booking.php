<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\BookingStatuses;


class Booking extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client_id',
        'master_id',
        'status',
        'car_brand',
        'car_model',
        'start_at',
        'end_at',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'status' => BookingStatuses::class,
    ];

    /**
     * @return BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * @return BelongsTo
     */
    public function master()
    {
        return $this->belongsTo(User::class, 'master_id');
    }

    /**
     * @return HasMany
     */
    public function notes()
    {
        return $this->hasMany(BookingNote::class);
    }

    /**
     * @return BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @return BelongsTo
     */
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * @return int
     */
    public function getDurationAttribute(): int
    {
        return $this->start_at->diffInMinutes($this->end_at);
    }
}
