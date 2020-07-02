<?php

namespace Microboard\Tests\App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'column', 'hidden'
    ];

    protected $hidden = [
        'hidden'
    ];
}
