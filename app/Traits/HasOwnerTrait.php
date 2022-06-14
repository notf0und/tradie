<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use PhpParser\Builder\Trait_;

trait HasOwnerTrait
{
    public static function bootHasOwnerTrait(): void
    {
        static::creating(function ($model) {
            $model->user_id = Auth::user()->id;
        });

        static::saving(function (Model $model) {
            static::isOwner($model);
        });

        static::deleting(function (Model $model) {
            static::isOwner($model);
        });
    }

    /**
     * @throws AuthorizationException
     */
    public static function isOwner(Model $model): void
    {
        if ($model->user_id && $model->user_id !== Auth::user()->id) {
            throw new AuthorizationException;
        }
    }

    public function scopeIsOwner($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
