<?php

namespace Iber\Console\UI;

use Iber\Console\Contracts\WindowableInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Drawer
 *
 * @package  Iber\Console\UI
 */
class Drawer
{
    /**
     *
     */
    const CHOICE_SELECTED = 'selected';
    /**
     *
     */
    const CHOICE_NORMAL = 'normal';
    /**
     *
     */
    const CHOICE_HOVERED = 'hovered';

    /**
     * @var array
     */
    protected $style = [
        self::CHOICE_NORMAL   => [
            self::CHOICE_NORMAL  => '<fg=white;bg=black>%s</>',
            self::CHOICE_HOVERED => '<fg=black;bg=white>%s</>'
        ],
        self::CHOICE_SELECTED => [
            self::CHOICE_NORMAL  => '<fg=green;bg=black>%s</>',
            self::CHOICE_HOVERED => '<fg=green;bg=white>%s</>'
        ],
        'title'               => '<fg=white;bg=black>%s</>'
    ];

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var WindowableInterface
     */
    protected $window;

    /**
     * Drawer constructor.
     *
     * @param OutputInterface     $output
     * @param WindowableInterface $window
     */
    public function __construct(OutputInterface $output, WindowableInterface $window)
    {
        $this->output = $output;
        $this->window = $window;
    }

    /**
     * Append spaces to the string to fit the whole terminal window
     *
     * @param int    $width
     * @param string $text
     * @param int    $padding
     *
     * @return string
     */
    public function fitText($width, $text = '', $padding = 0)
    {
        $spaces = $width - strlen($text) - $padding;

        return $text . str_repeat(' ', $spaces < 0 ? 0 : $spaces);
    }

    /**
     * Returns title
     *
     * @param $title
     * @return string
     */
    public function getTitle($title)
    {
        return sprintf($this->style['title'], $this->fitText($this->window->getWidth(), $title));
    }

    /**
     * Returns an array of styled options
     *
     * @param $choices
     * @param $position
     * @param $selected
     * @return array
     */
    public function getFormattedChoices(array $choices, $position, $selected)
    {
        $lines = [];

        foreach ($choices as $index => $choice) {
            $state = in_array($choice, $selected)
                ? self::CHOICE_SELECTED
                : self::CHOICE_NORMAL;

            $cursor = $index === $position
                ? self::CHOICE_HOVERED
                : self::CHOICE_NORMAL;

            // select which style to use
            $line = $this->style[$state][$cursor];

            // add the fancy fish eye symbol to make things prettier
            $choice = '  ' . unicode_to_string('\u25C9') . '  ' . $choice;

            $lines[] = sprintf($line, $this->fitText($this->window->getWidth(), $choice));
        }

        return $lines;
    }

    /**
     * Draw the window
     *
     * @param $title
     * @param $choices
     * @param $position
     * @param $answers
     * @return $this
     */
    public function drawWindow($title, $choices, $position, $answers)
    {
        $this->window->clearScreen();

        $this->output->writeln($this->getTitle($title));
        $this->output->writeln("");

        $lines = $this->getFormattedChoices($choices, $position, $answers);

        foreach ($lines as $line) {
            $this->output->writeln($line);
        }

        return $this;
    }

    /**
     * Open alternate window and clear it up
     */
    public function open()
    {
        $this->window->openAlternateScreen();
        $this->window->clearScreen();
    }

    /**
     * Clear screen, close the alternate window and return
     * back to the original window
     */
    public function closeWindow()
    {
        $this->window->clearScreen();
        $this->window->switchBack();
    }
}