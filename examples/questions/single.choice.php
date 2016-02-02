<?php

include __DIR__ . '/../../vendor/autoload.php';

$drawer = new \Iber\Console\UI\Drawer(
    new Symfony\Component\Console\Output\ConsoleOutput(),
    new \Iber\Console\UI\Window()
);

// allow only a single answer
$question = new \Iber\Console\Question\Question($drawer);
$question->setChoices([
    'Yep', 'Nope', 'Maybe'
]);
$question->setTitle('Isn\'t this awesome?');

$answer = $question->ask();

echo $answer, PHP_EOL;
