<?php

namespace AmphiBee\AcfBlocks\Traits;

trait Fields
{
    protected $fields;
    protected $loadAllField = false;

    /**
     * Instantiate all ACF field values inside the bloc view
     * @return $this
     */
    public function loadAllFields(): self
    {
        $this->loadAllField = true;
        return $this;
    }

    /**
     * Set the block fields
     * @param array $fields Array of fields declared via
     * WordPlate Extended ACF library
     * @return $this
     */
    public function setFields(array $fields): self
    {
        $this->fields = $fields;
        return $this;
    }

    /**
     * Get the block fields
     * @return array
     */
    public function getFields(): array
    {
        return $this->fields;
    }
}
