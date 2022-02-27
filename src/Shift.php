<?php

declare(strict_types=1);

namespace App;

use DateTime;
use InvalidArgumentException;

class Shift
{
    public $startTime;

    public $endTime;

    public $staffName;

    /**
     * Shift constructor.
     *
     * @param DateTime $startTime
     * @param DateTime $endTime
     * @param string $staffName
     */
    public function __construct(DateTime $startTime, DateTime $endTime, string $staffName)
    {
       

        if ($endTime <= $startTime) {
            throw new InvalidArgumentException('End time must be greater than start time.');
        }

        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->staffName = $staffName;
    }
}
