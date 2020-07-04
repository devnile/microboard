<?php

namespace Microboard\Http\Controllers;

use Microboard\Traits\Controller as MicroboardController;

class ResourceController extends Controller
{
    use MicroboardController;

    /**
     * Specify controller attributes.
     *
     * @var array
     */
    protected array $attributes = [
        'translations_prefix' => 'microboard',
        'views_prefix' => 'microboard',
        'views_path' => ''
    ];
}
