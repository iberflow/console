<?php

namespace Iber\Console\Contracts;

/**
 * Interface Question
 *
 * @package  Iber\Lizard\Contracts
 * @author   Ignas Bernotas <ignas@iber.lt>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://iber.lt/
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
