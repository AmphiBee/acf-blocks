<?php

namespace AmphiBee\AcfBlocks\Traits;

trait BlockParameters
{
    protected $mode = 'preview';
    protected $example = [];

    /**
     * Display mode
     * @param string $mode The display mode for your block. Available settings are "auto", "preview" and "edit". Defaults to "preview"
     * @return $this
     */
    public function setMode(string $mode): self
    {
        $this->mode = $mode;
        return $this;
    }

    /**
     * Get current display mode
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * This method enables the full height button on the toolbar of a
     * block and adds the $block[‘full_height’] property inside the
     * render template/callback. $block[‘full_height’] will only be
     * true if the full height button is enabled on the block in
     * the editor
     * @return $this
     */
    public function enableFullHeight(): self
    {
        $this->supports['full_height'] = true;
        return $this;
    }

    /**
     * This method disable the toggle between edit and preview modes
     * @return $this
     */
    public function disableMode(): self
    {
        $this->supports['mode'] = false;
        return $this;
    }

    /**
     * Disable the block custom class names
     * @return $this
     */
    public function disableCustomClasseName(): self
    {
        $this->supports['customClassName'] = false;
        return $this;
    }

    /**
     * Enable Anchor
     * @return $this
     */
    public function enableAnchor(): self
    {
        $this->supports['anchor'] = true;
        return $this;
    }

    /**
     * An array of structured data used to construct a preview shown
     * within the block-inserter. All values entered into the ‘data’
     * attribute array will become available within the block render
     * template/callback via $block['data'] or get_field().
     * @param array $example
     * @return $this
     */
    public function setExample(array $example): self
    {
        $this->example = $example;
        return $this;
    }

    public function getExample(): array
    {
        return $this->example;
    }
}
