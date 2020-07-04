<?php

namespace Microboard\Foundations\Traits;

trait WorkingWithWidgets
{
    /**
     * Get widgets for the specific view.
     *
     * @param $view
     * @return string
     */
    protected function getWidgetsFor($view)
    {
        $name = $view . "Widgets";

        if (
            in_array($view, ['create', 'update']) &&
            (empty($this->updateWidgets) && empty($this->createWidgets))
        ) {
            $name = 'formsWidgets';
        }

        if (property_exists($this, $name)) {
            return $this->$name;
        }

        return null;
    }
}
