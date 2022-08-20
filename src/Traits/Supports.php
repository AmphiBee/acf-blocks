<?php

namespace AmphiBee\AcfBlocks\Traits;

trait Supports
{
    protected $supports = [];


    /**
     * @param array $supports An array of features to support.
     * All properties from the JavaScript block supports
     * documentation may be used.
     * See https://www.advancedcustomfields.com/resources/acf_register_block_type/
     * @return $this
     */
    public function setSupports(array $supports): self
    {
        $this->supports = $supports;
        return $this;
    }

    /**
     * Get the current support values
     * @return array
     */
    public function getSupports(): array
    {
        return $this->supports;
    }

    /**
     * Add specific support
     * @param string $key Support key
     * @param mixed $value Support value
     * @return $this
     */
    public function addSupport(string $key, $value): self
    {
        $this->supports[$key] = $value;
        return $this;
    }

    /**
     * Get specific support value
     * @param string $key Support value
     * @return mixed
     */
    public function getSupport(string $key)
    {
        return isset($this->supports[$key]) ? $this->supports[$key] : null;
    }
}
