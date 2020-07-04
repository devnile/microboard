<?php

namespace Microboard\Foundations\Traits;

trait WorkingWithWidgets
{
    /**
     * Array of widgets that appear on index page.
     *
     * @var string[]
     */
    protected array $indexWidgets = [];

    /**
     * Array of widgets that appear on show page.
     *
     * @var string[]
     */
    protected $showWidgets = [];

    /**
     * Array of widgets that appear on create page.
     *
     * @var string[]
     */
    protected $createWidgets = [];

    /**
     * Array of widgets that appear on update page.
     *
     * @var string[]
     */
    protected $updateWidgets = [];

    /**
     * Array of widgets that appear on create and update.
     *
     * @var string[]
     */
    protected $formsWidgets = [];

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
