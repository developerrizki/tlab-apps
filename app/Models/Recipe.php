<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredients::class);
    }

    public function stepToCooks(): HasMany
    {
        return $this->hasMany(StepToCook::class);
    }
}
