<?php

namespace AmphiBee\AcfBlocks\Traits;

trait Metadata
{
    protected $name;
    protected $title;
    protected $description;
    protected $category = '';
    protected $icon = '';
    protected $keywords = [];
    protected $postTypes = [];

    /**
     * Name of the block
     * @param string $name A unique name that identifies the block (without namespace
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the name of the block
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the block title
     * @param string $title The display title for your block
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the block title
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the block description
     * @param string $description The description for your block
     * @return $this
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get the block description
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the block category
     * @param string $category The category for your block
     * @return $this
     */
    public function setCategory(string $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get the block category
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Get the block icon
     * @return string The icon for your block
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * Set the block icon
     * @param string $icon
     * @return $this
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * Set the block keywords
     * @param array $keywords An array of search terms to help user discover the block while searching.
     * @return $this
     */
    public function setKeywords(array $keywords): self
    {
        $this->keywords = $keywords;
        return $this;
    }

    /**
     * Get the block keywords
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->keywords;
    }

    /**
     * Restricted Post Types
     * @param array $postTypes An array of post types to restrict this block type to.
     * @return $this
     */
    public function setPostTypes(array $postTypes): self
    {
        $this->postTypes = $postTypes;
        return $this;
    }

    /**
     * Return the restricted post types
     * @return array
     */
    public function getPostTypes(): array
    {
        return $this->postTypes;
    }
}
