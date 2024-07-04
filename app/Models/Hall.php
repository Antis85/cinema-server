<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'total_rows',
        'total_cols',
        'price_standard',
        'price_vip',
        'is_started_sales'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_started_sales' => 'boolean',
    ];

    /**
     * Получить места, принадлежащие залу.
     * @return HasMany
     */
    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }

    /**
     * Получить сеансы, принадлежащие залу.
     * @return HasMany
     */
    public function seances(): HasMany
    {
        return $this->hasMany(Seance::class);
    }

    /**
     * Получить фильмы, принадлежащие залу, через сеансы.
     * @return belongsToMany
     */
    public function movies(): belongsToMany
    {
        return $this->belongsToMany(Movie::class, 'seances');
    }
}
