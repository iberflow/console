<?php

namespace Iber\Console\Contracts;

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
     * @return mixed
     */
    public function getWidth();

    /**
     * @return mixed
     */
    public function getHeight();
}
