<?php

namespace Iber\Console\UI;

/**
 * Class Cursor
 *
 * @package Iber\Console\UI
 */
class Cursor
{
    /**
     * @var int
     */
    protected $position = 0;

    /**
     * @param $totalPositions
     * @return $this
     */
    public function moveDown($totalPositions)
    {
        $this->position = ($totalPositions > $this->position + 1)
            ? $this->position + 1
            : 0;

        return $this;
    }

    /**
     * @param $totalPositions
     * @return $this
     */
    public function moveUp($totalPositions)
    {
        $this->position = ($this->position - 1 >= 0)
            ? $this->position - 1
            : $totalPositions - 1;

        return $this;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }
}
