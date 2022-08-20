# ACF Blocks

Quickly declare your Gutenberg blocks with ACF and WordPlate Extended ACF

## Requirements

The package requires the following plugins:

- Advanced Custom Fields Pro
- WordPlate Extended ACF (included in the ACF Blocks package)

## Installation

Require this package, with Composer, in the root directory of your project.

```bash
composer require amphibee/acf-blocks
```

## Usage

### Declaring a block

```php
use \AmphiBee\AcfBlocks\Block;
use \Extended\ACF\Fields\Text;
use \Extended\ACF\Fields\Textarea;

Block::make('My beautiful block', 'my_beautiful_block')
    ->setFields([
        Text::make('Title', 'title'),
        Textarea::make('Content', 'content'),
    ])
    ->disableCustomClasseName()
    ->setAllowedBlocks([
        'core/paragraph',
        'core/heading',
    ])
    ->setJsxTemplate([
        ['core/heading', [
            'level' => 2,
            'placeholder' => 'Title Goes Here',
        ]],
        ['core/paragraph', [
            'placeholder' => 'Content goes here',
        ]]
    ])
    ->loadAllFields()
    ->setMode('edit')
    ->setIcon('format-aside')
    ->setAlign('full')
    ->enableJsx()
    ->setRenderTemplate('partials/my-beautiful-block.php');
```

ACF Blocks is also compatible with Blade views !

```php
use \AmphiBee\AcfBlocks\Block;
use \Extended\ACF\Fields\Text;
use \Extended\ACF\Fields\Textarea;

Block::make('My beautiful block', 'my_beautiful_block')
    ->setFields([
        \Extended\ACF\Fields\Text::make('Title', 'title'),
        \Extended\ACF\Fields\Textarea::make('Content', 'content'),
    ])
    ->setMode('preview')
    ->setIcon('editor-code')
    ->setAlign('wide')
    ->enableJsx()
    ->setView('partials.my-beautiful-block');
```

### Rendering a block

**Raw PHP template**

```php
<div class="p-4">
    <h1><?php echo $field->title; ?></h1>
    <p><?php echo $field->content; ?></p>
    <?php echo $innerBlocks ?>
</div>
```

**Blade view**

```php
<div class="p-4">
    <h1>{{$field->title}}</h1>
    <p>{{$field->content}}</p>
    {!! $innerBlocks !!}
</div>
```

### Declaring a category

```php
use \AmphiBee\AcfBlocks\BlockCategory;

BlockCategory::make('My beautiful category', 'my_beautiful_category')
    ->setIcon('wordpress')
```
