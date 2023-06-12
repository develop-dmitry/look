<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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

    public function clothes(): MorphToMany
    {
        return $this->morphToMany(Clothes::class, 'model', 'model_has_clothes');
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
