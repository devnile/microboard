<?php

namespace Microboard\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
{
    use InteractsWithMedia;

    /**
     * User constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->fillable = array_merge([
            'role_id', 'name', 'email', 'password'
        ], $this->fillable);

        parent::__construct($attributes);
    }

    /**
     * @return BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Retrieve role's permissions
     *
     * @return Collection
     */
    public function permissions()
    {
        return $this->role->permissions;
    }

    /**
     * Register media library collections.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->useFallbackPath($avatar = asset('/storage/user-placeholder.png'))
            ->useFallbackUrl($avatar);
    }

    /**
     * Hash the password whenever updating.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get user's avatar or get the placeholder
     *
     * @return string
     */
    public function getAvatarAttribute()
    {
        return $this->getFirstMediaUrl('avatar');
    }
}
