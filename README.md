[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/iber/console/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/iber/console/?branch=master)

# Console
A number of PHP CLI based classes and helpers

![Example](https://iber.lt/projects/console.gif)

------------
 - Single choice/Multiple choice questions with arrow key option selection
 - Process signal handler
 
## Installation
Install it via composer:
```
composer require ignasbernotas/console
```

## Limitations
This package only works on UNIX/Linux based systems since the Windows PHP version doesn't not support the readline extension (which is required by ```iber/phkey``` package.

## Examples
Located in ```examples/``` folder

## License
Licensed under MIT.
