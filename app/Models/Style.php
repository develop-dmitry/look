<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Style extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function clothes(): MorphToMany
    {
        return $this->morphedByMany(Clothes::class, 'model', 'model_has_styles');
    }

    public function users(): MorphToMany
    {
        return $this->morphedByMany(User::class, 'model', 'model_has_styles');
    }
}
