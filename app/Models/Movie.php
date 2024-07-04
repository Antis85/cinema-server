<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'duration_minutes',
        'origin',
        'picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * Получить сеансы, принадлежащие фильму.
     * @return HasMany
     */
    public function seances(): HasMany
    {
        return $this->hasMany(Seance::class);
    }

    /**
     * Получить залы, принадлежащие фильму, через сеансы.
     * @return belongsToMany
     */
    public function halls(): belongsToMany
    {
        return $this->belongsToMany(Hall::class, 'seances')->where('is_started_sales', true)->withPivot('id', 'start_time');
    }
}
