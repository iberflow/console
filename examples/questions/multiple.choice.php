<?php

include __DIR__ . '/../../vendor/autoload.php';

$drawer = new \Iber\Console\UI\Drawer(
    new Symfony\Component\Console\Output\ConsoleOutput(),
    new \Iber\Console\UI\Window()
);

// allow multiple answers
$question = new \Iber\Console\Question\MultipleChoiceQuestion($drawer);
$question->setChoices([
    'Yep', 'Nope', 'Maybe'
]);
$question->setTitle('Isn\'t this awesome?');

$answers = $question->ask();

foreach ($answers as $answer) {
    echo "Selected: ", $answer, PHP_EOL;
}
