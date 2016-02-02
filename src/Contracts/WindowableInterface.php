<?php

namespace Iber\Console\Contracts;

/**
 * Interface WindowableInterface
 *
 * @package  Iber\Console\Contracts
 */
interface WindowableInterface
{
    /**
     * @return mixed
     */
    public function openAlternateScreen();

    /**
     * @return mixed
     */
    public function switchBack();

    /**
     * @return mixed
     */
    public function clearScreen();

    /**
     * @return integer
     */
    public function getWidth();

    /**
     * @return integer
     */
    public function getHeight();

    /**
     * @return mixed
     */
    public function setTitle();
}
