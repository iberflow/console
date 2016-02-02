<?php

include __DIR__ . '/../../vendor/autoload.php';

$cursor = new \Iber\Console\UI\Cursor();
$drawer = new \Iber\Console\UI\Drawer(
    new Symfony\Component\Console\Output\ConsoleOutput(),
    new \Iber\Console\UI\Window()
);

// allow only a single answer
$question = new \Iber\Console\Question\Question($cursor, $drawer);
$question->setChoices([
    'Yep', 'Nope', 'Maybe'
]);
$question->setTitle('Isn\'t this awesome?');

$answer = $question->ask();

print_r($answer);