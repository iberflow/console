<?php

include __DIR__ . '/../vendor/autoload.php';

$window = new \Iber\Console\UI\Window();
$window->setTitle('My App');

echo "Window size: ", $window->getHeight(), 'x', $window->getWidth(), PHP_EOL;
