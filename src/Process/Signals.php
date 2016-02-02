<?php

namespace Iber\Console\Process;

use Closure;

class Signals
{
    /**
     * Array of signal listener closures
     *
     * @type array
     */
    protected $listeners = [];

    /**
     * Handle application exit signals
     *
     * @param \Closure $callback callback to run after the signal is received
     *
     * @return void
     */
    public function handleExit(\Closure $callback)
    {
        // You cannot assign a signal handler for SIGKILL

        $this->append(SIGHUP, $callback);
        $this->append(SIGINT, $callback);
        $this->append(SIGQUIT, $callback);
        $this->append(SIGTERM, $callback);
    }

    /**
     * Add signal listener
     *
     * @param int      $signal   signal id
     * @param \Closure $callback function to run when the signal is
     *                           received
     *
     * @return $this
     */
    public function append($signal, Closure $callback)
    {
        if (empty($this->listeners)) {
            declare(ticks = 1);
        }

        $this->listeners[$signal] = $callback;

        pcntl_signal($signal, [$this, "executeListener"]);

        return $this;
    }

    /**
     * Method which is executed when a signal is received
     *
     * @param int  $signal signal Id
     * @param bool $exit
     *
     * @return mixed
     */
    public function executeListener($signal, $exit = true)
    {
        $return = null;

        if (isset($this->listeners[$signal])) {
            $return = call_user_func_array($this->listeners[$signal], [$signal]);
        }

        if (true === $exit) {
            // exit the application
            posix_kill(posix_getpid(), SIGKILL);
        }

        return $return;
    }
}
