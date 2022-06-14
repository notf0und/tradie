<?php

namespace App\Models;

use App\Traits\HasOwnerTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Job extends Model
{
    use HasFactory, HasOwnerTrait;

    public function contact(): HasOne
    {
        return $this->hasOne(Contact::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}
