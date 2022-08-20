<?php

namespace AmphiBee\AcfBlocks\Traits;

trait Jsx
{
    protected $jsxTemplate = [];
    protected $allowedBlocks = [];
    protected $templateLock;

    /**
     * Enable JSX support
     * @return $this
     */
    public function enableJsx(): self
    {
        $this->supports['jsx'] = true;
        return $this;
    }

    /**
     * Set the InnerBlock template
     * @param array $template Array of blocks. See https://developer.wordpress.org/block-editor/reference-guides/block-api/block-templates/
     * @return $this
     */
    public function setJsxTemplate(array $template): self
    {
        $this->jsxTemplate = $template;
        return $this;
    }

    /**
     * Set the InnerBlock allowed blocks
     * @param array $allowedBlocks Array of blocks
     * @return $this
     */
    public function setAllowedBlocks(array $allowedBlocks): self
    {
        $this->allowedBlocks = $allowedBlocks;
        return $this;
    }

    /**
     * Set the InnerBlock template lock settings
     * @param array $templateLock InnerBlock template lock settings (possible value : all|insert|move|delete)
     * @return $this
     */
    public function setTemplateLock($templateLock): self
    {
        $this->templateLock = $templateLock;
        return $this;
    }
}
