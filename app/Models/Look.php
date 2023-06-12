<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Look extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'photo',
        'min_temperature',
        'max_temperature',
        'average_temperature'
    ];

    public function clothes(): BelongsToMany
    {
        return $this->belongsToMany(Clothes::class, 'clothes_look');
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
