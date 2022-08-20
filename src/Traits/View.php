<?php

namespace AmphiBee\AcfBlocks\Traits;

trait View
{
    /**
     * Render the template
     * @param string $tpl Template file or view path
     * @param array $args View arguments
     * @return void
     */
    public function render(string $tpl = '', array $args = [])
    {
        $tpl = str_replace(['.blade.php'], '', $tpl);

        if (function_exists('view') && view()->exists($tpl)) {
            echo view($tpl, $args);
            return;
        }
        if (function_exists('\Roots\view') && \Roots\view()->exists($tpl)) {
            echo \Roots\view($tpl, $args);
            return;
        }

        $locatedTemplate = locate_template($tpl, false, false, $args);

        if ($locatedTemplate) {
            extract($args);
            include($locatedTemplate);
        }
    }
}
