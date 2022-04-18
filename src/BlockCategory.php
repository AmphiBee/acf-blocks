<?php

namespace AmphiBee\AcfBlocks;

use WordPlate\Acf\Location;

class BlockCategory
{

    protected $name;
    protected $title;
    protected $icon = '';

    public function __construct(string $title, ?string $name = null)
    {
        $this->setName($name ?? str_replace('\\', '-', strtolower(get_class($this))) . '-' . acf_slugify($title));
        $this->setTitle($title);

        add_filter('block_categories_all', [$this, 'registerCategory'], 10, 2);
    }

    /**
     * Instantiate a new category
     * @param string $title The display title for your category
     * @param string|null $name A unique name that identifies the category (without namespace)
     * @return static
     */
    public static function make(string $title, string $name = null): self
    {
        return new static($title, $name);
    }

    /**
     * Register custom Category Blocks
     * @return void
     */
    public function registerCategory($categories)
    {
        $new_category = [
            'title' => $this->getTitle(),
            'slug' => $this->getName(),
            'icon' => $this->getIcon(),
        ];
        array_unshift($categories, $new_category);

        return $categories;
    }

    /**
     * Name of the category
     * @param string $name A unique name that identifies the category (without namespace)
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the name of the category
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the category title
     * @param string $title The display title for your category
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get the category title
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the category icon
     * @param string $icon The icon for your category
     * @return $this
     */
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }
    
    /**
     * Get the category icon
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }
}
