<?php
namespace AmphiBee\AcfBlocks;

use WordPlate\Acf\Location;

class Block {

    protected $name;
    protected $title;
    protected $description;
    protected $category;
    protected $icon = '';
    protected $keywords = [];
    protected $fields;
    protected $renderTemplate;
    protected $loadAllField = false;
    protected $postTypes = [];
    protected $mode = 'preview';
    protected $align = '';
    protected $alignText;
    protected $alignContent = 'top';
    protected $enqueueScript;
    protected $enqueueStyle;
    protected $supports = [];

    public function __construct(string $title, ?string $name = null)
    {
        $this->setName($name ?? str_replace('\\', '-', strtolower(get_class($this))) . '-' .  acf_slugify($title));
        $this->setTitle($title);

        add_action('acf/init', [$this, 'registerBlock']);
        add_action('acf/init', [$this, 'registerFieldGroup']);
    }

    /**
     * Instantiate a new block
     * @param string $title The display title for your block
     * @param string|null $name A unique name that identifies the block (without namespace)
     * @return static
     */
    public static function make(string $title, string $name = null): self
    {
        return new static($title, $name);
    }

    /**
     * Register ACF Gutenberg Block
     * @return void
     */
    public function registerBlock()
    {
        acf_register_block_type([
            'title' => $this->getTitle(),
            'name' => $this->getName(),
            'icon' => $this->getIcon(),
            'post_types' => $this->getPostTypes(),
            'mode' => $this->getMode(),
            'align' => $this->getAlign(),
            'align_text' => $this->getAlignText(),
            'align_content' => $this->getAlignContent(),
            'enqueue_script' => $this->getEnqueueScript(),
            'enqueue_style' => $this->getEnqueueStyle(),
            'supports' => $this->getSupports(),
            'keywords' => $this->getKeywords(),
            'render_callback' => function($block) {

                $viewArgs = [
                    'block' => $block,
                    'instance' => $this,
                ];

                if ($this->loadAllField) {
                    $viewArgs['fields'] = (object) get_fields();
                }
                echo view($this->renderTemplate, $viewArgs);
            },
        ]);
    }

    /**
     * Register the field group if fields are defined
     * @return void
     */
    public function registerFieldGroup()
    {
        if ($this->fields) {
            $name = acf_slugify($this->name);
            register_extended_field_group([
                'title' => $this->getTitle(),
                'fields' => $this->getFields(),
                'location' => [Location::if('block', 'acf/' . $name)],
            ]);
        }
    }

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
     * Name of the block
     * @param string $name  A unique name that identifies the block (without namespace
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
     * Set the block category
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Set the block icon
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
     * Set the block keywords
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

    /**
     * @param array $supports An array of features to support. All properties from the JavaScript block supports documentation may be used. See https://www.advancedcustomfields.com/resources/acf_register_block_type/
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
        return $this->supports[$key];
    }

    /**
     * Set the render template
     * @param string $renderTemplate Path to the render template (blade path)
     * @return $this
     */
    public function setRenderTemplate(string $renderTemplate): self
    {
        $this->renderTemplate = $renderTemplate;
        return $this;
    }

    /**
     * Get the render template (blade path)
     * @return string
     */
    public function getRenderTemplate(): string
    {
        return $this->renderTemplate;
    }

    /**
     * Set the block fields
     * @param array $fields Array of fields declared via WordPlate Extended ACF library
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