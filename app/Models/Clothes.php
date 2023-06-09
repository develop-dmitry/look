<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Clothes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'photo'
    ];

    public function styles(): MorphToMany
    {
        return $this->morphToMany(Style::class, 'model', 'model_has_styles');
    }

    public function looks(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'model', 'model_has_clothes');
    }

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'model', 'model_has_clothes');
    }
}
