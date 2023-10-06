<?php

namespace AmphiBee\AcfBlocks\Traits;

trait Template
{
    protected $renderTemplate;
    protected array $viewData = [];
    
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
     * Set the view data
     * @param array $data Data to pass to the view
     * @return $this
     */
    public function setViewData(array $data): self
    {
        $this->viewData = $data;
        return $this;
    }

    /**
     * Get the view data
     * @return array
     */
    public function getViewData(): array
    {
        return $this->viewData;
    }

    /**
     * Shortcut for setRenderTemplate (More Blade friendly)
     * @param string $renderTemplate Path to the render template (blade path)
     * @return $this
     */
    public function setView(string $view, array $data = []): self
    {
        $this->setRenderTemplate($view);
        $this->setViewData($data);
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
