<?php

/**
 * @NOTE
 *
 * declare(ticks = 1) is required at the beginning of the script
 */
declare(ticks = 1);

include __DIR__ . '/../vendor/autoload.php';

$signal = new \Iber\Console\Process\Signals();

$signal->handleExit(function () {
    echo PHP_EOL, "Normally you can't gracefully shutdown the process when it's killed/interrupted", PHP_EOL;
});

echo "Starting an infinite while loop.", PHP_EOL;
echo "Press CTRL+C to kill the process.", PHP_EOL;

posix_kill(posix_getpid(), SIGINT);

while (true) {
  // some long job
}