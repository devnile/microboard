<?php

namespace Microboard\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function scopeGroupByModel(Builder $query)
    {
        return $query->get()
            ->sortBy('id')
            ->groupBy(function (Permission $permission) {
                return explode('-', $permission->name)[0];
            });
    }
}
