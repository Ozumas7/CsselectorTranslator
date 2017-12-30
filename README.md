# Csselector PHP Translator

This library parse Csselector into PHP, I was doing an html parser and 
needed a Csselector parser to support finding elements with csselectors.

The symfony component converts CSS selectors to XPath expressions but that
didn't work for me so I create this so I can use the component for differente purposes.


## Instalation

```php
use Kolter\CsselectorTranslator\CsselectorTranslator;

$query = "p.class1.class2.class3 > div[href^=https],img:first-child

$translator = new CsselectorTranslator();
$elements = $translator->parse();
// This will return an array of Element
echo $elements[0];
// Output: "p.class1.class2#id>div[href^=https],img"
// Element 0 is the p tag but the __toString() method will output the conection 
//between elements so it will show the whole selector
$element[0]->getClasses();
// Output: ['class1','class2']
$elements[0]->getId();
// Output: "id"

```

