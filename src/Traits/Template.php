<?php

namespace AmphiBee\AcfBlocks\Traits;

trait Template
{
    protected $renderTemplate;
    
    /**
     * Set the render template
     * @param string $renderTemplate Path to the render template
     * @return $this
     */
    public function setRenderTemplate(string $renderTemplate): self
    {
        $this->renderTemplate = $renderTemplate;
        return $this;
    }

    /**
     * Get the render template
     * @return string
     */
    public function getRenderTemplate(): string
    {
        return $this->renderTemplate;
    }

    /**
     * Shortcut for setRenderTemplate (More Blade friendly)
     * @param string $renderTemplate Path to the render template (blade path)
     * @return $this
     */
    public function setView(string $view): self
    {
        $this->setRenderTemplate($view);
        return $this;
    }

    /**
     * Shortcut for getRenderTemplate (More Blade friendly)
     * @return string
     */
    public function getView(): string
    {
        return $this->getRenderTemplate();
    }

}
