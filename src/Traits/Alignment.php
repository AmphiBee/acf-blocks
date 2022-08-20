<?php

namespace AmphiBee\AcfBlocks\Traits;

trait Alignment
{
    protected $align = '';
    protected $alignText;
    protected $alignContent = 'top';

    /**
     * Default block alignment
     * @param string $align The default block alignment. Available settings are "left", "center", "right", "wide" and "full". Defaults to an empty string.
     * @return $this
     */
    public function setAlign(string $align): self
    {
        $this->align = $align;
        return $this;
    }

    /**
     * Get the default block alignment
     * @return string
     */
    public function getAlign(): string
    {
        return $this->align;
    }

    /**
     * Default block text alignment
     * @param string $alignText The default block text alignment (see supports setting for more info). Available settings are "left", "center" and "right". Defaults to the current language’s text alignment.
     * @return $this
     */
    public function setAlignText(string $alignText): self
    {
        $this->alignText = $alignText;
        return $this;
    }

    /**
     * Get the default block text alignment
     * @return mixed
     */
    public function getAlignText()
    {
        return $this->alignText;
    }

    /**
     * Default block content alignment
     * @param string $alignContent The default block content alignment (see supports setting for more info). Available settings are "top", "center" and "bottom". When utilising the "Matrix" control type, additional settings are available to specify all 9 positions from "top left" to "bottom right".
     * @return $this
     */
    public function setAlignContent(string $alignContent): self
    {
        $this->alignContent = $alignContent;
        return $this;
    }

    /**
     * Get the default block content alignment
     * @return string
     */
    public function getAlignContent(): string
    {
        return $this->alignContent;
    }

    /**
     * This disables the toolbar button to control the block’s
     * alignment.
     * @return $this
     */
    public function disableAlign(): self
    {
        $this->supports['align'] = false;
        return $this;
    }

    /**
     * Customize alignment toolbar
     * @param array $alignSupport
     * @return $this
     */
    public function setAlignSupport(array $alignSupport): self
    {
        $this->supports['align'] = $alignSupport;
        return $this;
    }

    /**
     * This property enables a toolbar button to control the block's
     * text alignment
     * @return $this
     */
    public function enableAlignText(): self
    {
        $this->supports['align_text'] = true;
        return $this;
    }

    /**
     * This method enables a toolbar button to control the block's
     * inner content alignment
     * @return $this
     */
    public function enableAlignContent(): self
    {
        $this->supports['align_content'] = true;
        return $this;
    }

    /**
     * This method control the block's inner content alignment.
     * Set to true to show the alignment toolbar button, or set
     * to 'matrix' to enable the full alignment matrix in the toolbar
     * @param mixed $setting
     * @return $this
     */
    public function setAlignContentSupport($setting): self
    {
        $this->supports['align_content'] = $setting;
        return $this;
    }
}
