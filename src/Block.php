<?php

namespace AmphiBee\AcfBlocks;

use AmphiBee\AcfBlocks\Traits\Alignment;
use AmphiBee\AcfBlocks\Traits\Assets;
use AmphiBee\AcfBlocks\Traits\BlockParameters;
use AmphiBee\AcfBlocks\Traits\Fields;
use AmphiBee\AcfBlocks\Traits\Jsx;
use AmphiBee\AcfBlocks\Traits\Metadata;
use AmphiBee\AcfBlocks\Traits\Supports;
use AmphiBee\AcfBlocks\Traits\Template;
use AmphiBee\AcfBlocks\Traits\View;
use Extended\ACF\Location;

class Block
{

    use Supports;
    use Assets;
    use Jsx;
    use Template;
    use Alignment;
    use Metadata;
    use BlockParameters;
    use Fields;
    use View;

    public function __construct(string $title, ?string $name = null)
    {
        $this->setName($name ?? str_replace('\\', '-', strtolower(get_class($this))) . '-' . acf_slugify($title));
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
            'category' => $this->getCategory(),
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
            'render_callback' => function ($block) {

                $viewArgs = [
                    'block' => $block,
                    'instance' => $this,
                    'viewData' => $this->getViewData(),
                ];

                $viewArgs['innerBlocks'] = '';

                if ($this->getSupport('jsx')) {
                    $innerBlockAttrs = '';
                    if (count($this->jsxTemplate) > 0) {
                        $viewArgs['template_attr'] = ' template="' . esc_attr(wp_json_encode($this->jsxTemplate)) . '"';
                        $innerBlockAttrs .= $viewArgs['template_attr'];
                    }

                    if (count($this->allowedBlocks) > 0) {
                        $viewArgs['allowed_block_attr'] = ' allowedBlocks="' . esc_attr(wp_json_encode($this->allowedBlocks)) . '"';
                        $innerBlockAttrs .= $viewArgs['allowed_block_attr'];
                    }

                    if ($this->templateLock) {
                        $viewArgs['template_lock_attr'] = ' templateLock="' . $this->templateLock . '"';
                        $innerBlockAttrs .= $viewArgs['template_lock_attr'];
                    }
                    $viewArgs['innerBlocks'] = "<InnerBlocks{$innerBlockAttrs} />";
                }

                if ($this->loadAllField) {
                    $viewArgs['field'] = (object)get_fields();
                }

                $this->render($this->renderTemplate, $viewArgs);
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
                'location' => [Location::where('block', 'acf/' . $name)],
            ]);
        }
    }
}
