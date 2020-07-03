<?php

namespace Microboard\Foundations;

use Illuminate\Support\Collection;

class Localization
{
    /**
     * @var Collection
     */
    private $lang;

    /**
     * Localization constructor.
     */
    public function __construct()
    {
        $this->lang = collect(config('microboard.localizations', []));
    }

    /**
     * @return array
     */
    public function getLocale()
    {
        return $this->lang->where('code', app()->getLocale())->first();
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->getLocale()['dir'] ?? 'ltr';
    }

    /**
     * @return bool
     */
    public function isRTL()
    {
        return $this->getDirection() === 'rtl';
    }
}
