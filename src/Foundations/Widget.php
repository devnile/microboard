<?php

namespace Microboard\Foundations;

use Arrilot\Widgets\AbstractWidget;

class Widget extends AbstractWidget
{
    /**
     * Async and reloadable widgets are wrapped in container.
     * You can customize it by overriding this method.
     *
     * @return array
     */
    public function container()
    {
        $size = $this->config['size'] ?? 'col-xl-3 xol-md-4';

        return [
            'element'       => 'div',
            'attributes'    => 'class="'. $size .'"',
        ];
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return true;
    }
}
