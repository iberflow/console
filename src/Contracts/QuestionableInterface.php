<?php

namespace Iber\Console\Contracts;

/**
 * Interface QuestionableInterface
 *
 * @package Iber\Console\Contracts
 */
interface QuestionableInterface
{
    /**
     * @param $title
     * @return mixed
     */
    public function setTitle($title);

    /**
     * @param array $options
     * @return mixed
     */
    public function setChoices(array $options);

    /**
     * @param array $answers
     * @return mixed
     */
    public function setAnswers(array $answers);

    /**
     * @return array
     */
    public function getAnswers();

    /**
     * @return mixed
     */
    public function ask();
}
