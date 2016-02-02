<?php

namespace Iber\Console\Question;

/**
 * Class MultipleChoiceQuestion
 *
 * @package Iber\Console\Question
 */
class MultipleChoiceQuestion extends Question
{
    /**
     * Returns an array of answers
     *
     * @return array
     */
    public function getAnswers()
    {
        return $this->answers;
    }

    /**
     * Allows selecting multiple choices
     *
     * @return $this
     */
    protected function selectChoice()
    {
        $index = array_search(
            $this->choices[$this->cursor->getPosition()],
            $this->answers
        );

        if (false !== $index) {
            unset($this->answers[$index]);
        } else {
            $this->answers[] = $this->choices[$this->cursor->getPosition()];
        }

        $this->answers = array_values($this->answers);

        return $this;
    }
}
