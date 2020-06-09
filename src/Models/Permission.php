<?php

namespace Microboard\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name'
    ];

    /**
     * disabled created_at, updated_at fields
     *
     * @var bool
     */
    public $timestamps = false;
}
