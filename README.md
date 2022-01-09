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


```php
use \AmphiBee\AcfBlocks\Block;
use \WordPlate\Acf\Fields\Text;
use \WordPlate\Acf\Fields\Textarea;

Block::make('My Beautiful Block', 'my-beautiful-block')
    ->setFields([
        Text::make('Title', 'titre'),
        Textarea::make('Text', 'texte'),
    ])
    ->loadAllFields()
    ->setMode('edit')
    ->setIcon('format-aside')
    ->setAlign('full')
    ->addSupport('jsx', true)
    ->setRenderTemplate('partials.my-beautiful-block');
```
