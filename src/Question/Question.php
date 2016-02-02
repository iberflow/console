<?php

namespace Iber\Console\Question;

use Iber\Console\Contracts\QuestionableInterface;
use Iber\Console\UI\Cursor;
use Iber\Console\UI\Drawer;
use Iber\Phkey\Environment\Detector;

/**
 * Class Question
 *
 * @package Iber\Console\Question
 */
class Question implements QuestionableInterface
{
    /**
     * @var
     */
    protected $title;
    /**
     * @var array
     */
    protected $choices = [];
    /**
     * @var array
     */
    protected $answers = [];

    /**
     * @var Cursor
     */
    protected $cursor;
    /**
     * @var Drawer
     */
    protected $drawer;

    /**
     * Question constructor.
     *
     * @param Drawer $drawer
     * @param Cursor $cursor
     */
    public function __construct(Drawer $drawer, Cursor $cursor = null)
    {
        if(null === $cursor) {
            $cursor = new Cursor();
        }

        $this->cursor = $cursor;
        $this->drawer = $drawer;
    }

    /**
     * Title setter
     *
     * @param  $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Choice setter
     *
     * @param  array $choices
     * @return $this
     */
    public function setChoices(array $choices)
    {
        $this->choices = $choices;

        return $this;
    }

    /**
     * Answer setter
     *
     * @param  array $answers
     * @return $this
     */
    public function setAnswers(array $answers)
    {
        $this->answers = $answers;

        return $this;
    }

    /**
     * Returns the answer
     *
     * @return null
     */
    public function getAnswers()
    {
        if (isset($this->answers[0])) {
            return $this->answers[0];
        }

        return null;
    }

    /**
     * Asks the question
     *
     * @return array
     */
    public function ask()
    {
        $this->drawer->open();

        $phkey = new Detector();
        $listener = $phkey->getListenerInstance();
        $event = $listener->getEventDispatcher();

        $event->addListener(
            'key:up',
            function () {
                $this->cursor->moveUp(count($this->choices));
                $this->draw();
            }
        );

        $event->addListener(
            'key:down',
            function () {
                $this->cursor->moveDown(count($this->choices));
                $this->draw();
            }
        );

        $event->addListener(
            'key:space',
            function () {
                $this->selectChoice();
                $this->draw();
            }
        );

        $event->addListener(
            'key:enter',
            function () use ($event) {
                $event->dispatch('key:stop:listening');
                $this->drawer->closeWindow();
            }
        );

        $this->draw();
        $listener->start();

        return $this->getAnswers();
    }

    /**
     * Draws the window
     */
    protected function draw()
    {
        $this->drawer->drawWindow(
            $this->title,
            $this->choices,
            $this->cursor->getPosition(),
            $this->answers
        );
    }

    /**
     * Sets a single answer
     *
     * @return $this
     */
    protected function selectChoice()
    {
        $this->answers = [
            $this->choices[$this->cursor->getPosition()]
        ];

        return $this;
    }
}
