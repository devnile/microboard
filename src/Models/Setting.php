<?php

namespace Microboard\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Setting extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'group', 'key', 'title', 'value', 'type', 'options'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'options' => 'array'
    ];

    /**
     * Return the value for the given key.
     *
     * @param string $delimiter
     * @param string $default
     * @return string|null
     */
    public static function getValueFor($delimiter, $default = '')
    {
        $key = explode('.', $delimiter);
        $group = $key[0];

        if (! isset($key[1])) {
            throw new \InvalidArgumentException("There is no key provided!");
        }
        $key = $key[1];

        return optional(self::where('key', $key)->where('group', $group)->first())->value ?? $default;
    }
}
