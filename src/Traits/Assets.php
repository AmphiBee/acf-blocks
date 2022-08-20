<?php

namespace AmphiBee\AcfBlocks\Traits;

trait Assets
{
    protected $enqueueScript;
    protected $enqueueStyle;

    /**
     * Set the script to enqueue
     * @param string $enqueueScript The url to a .js file to be enqueued whenever your block is displayed (front-end and back-end).
     * @return $this
     */
    public function setEnqueueScript(string $enqueueScript): self
    {
        $this->enqueueScript = $enqueueScript;
        return $this;
    }

    /**
     * Get the enqueued script
     * @return mixed
     */
    public function getEnqueueScript()
    {
        return $this->enqueueScript;
    }

    /**
     * Set the style to enqueue
     * @param string $enqueueStyle The url to a .css file to be enqueued whenever your block is displayed (front-end and back-end).
     * @return $this
     */
    public function setEnqueueStyle(string $enqueueStyle): self
    {
        $this->enqueueStyle = $enqueueStyle;
        return $this;
    }

    /**
     * Get the enqueued style
     * @return mixed
     */
    public function getEnqueueStyle()
    {
        return $this->enqueueStyle;
    }
}
