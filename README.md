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
use \WordPlate\Acf\Fields\Text;
use \WordPlate\Acf\Fields\Textarea;

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
    ->setRenderTemplate('partials.my-beautiful-block');
```

### Rendering a block

```php
<div class="p-4">
    <h1>{{$field->title}}</h1>
    <p>{{$field->content}}</p>
    {!! $innerBlocks !!}
</div>
