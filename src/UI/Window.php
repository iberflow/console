<?php

namespace Iber\Console\UI;

use Iber\Console\Contracts\WindowableInterface;

/**
 * Class Window
 *
 * @package  Iber\Console\UI
 */
class Window implements WindowableInterface
{
    /**
     * Save cursor position & switch to alternate screen
     */
    public function openAlternateScreen()
    {
        fwrite(STDOUT, "\0337\033[?47h");
    }

    /**
     * Clear alternate screen, switch back to primary, restore cursor
     */
    public function switchBack()
    {
        fwrite(STDOUT, "\033[2J\033[?47l\0338");
    }

    /**
     *  Clear the screen
     */
    public function clearScreen()
    {
        fwrite(STDOUT, "\033[H\033[2J");
    }

    /**
     * Get terminal window width
     *
     * @return int
     */
    public function getWidth()
    {
        $cols = intval(`tput cols`);

        return $cols;
    }

    /**
     * Get terminal window height
     *
     * @return int
     */
    public function getHeight()
    {
        $rows = intval(`tput lines`);

        return $rows;
    }

    /**
     * Set window title
     *
     * @param $title
     */
    public function setTitle($title) {
        fwrite(STDOUT, "\033]0;$title\007");
    }
}
