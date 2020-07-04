<?php

namespace Microboard\Models;

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
        'key', 'name', 'value', 'cast'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'cast' => 'collection'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'type', 'extra'
    ];

    /**
     * Return the value for the given key.
     *
     * @param string $key
     * @param null $default
     * @return string|null
     */
    public static function getValueFor($key, $default = null)
    {
        return optional(self::where('key', $key)->first())->value ?? $default;
    }

    /**
     * Get field's type.
     *
     * @return string
     */
    public function getTypeAttribute()
    {
        return $this->cast->get('type', 'text');
    }

    /**
     * Get Extra field's attributes.
     *
     * @return array
     */
    public function getExtraAttribute()
    {
        return json_decode($this->cast->get('extra', '{}'), true);
    }
}
