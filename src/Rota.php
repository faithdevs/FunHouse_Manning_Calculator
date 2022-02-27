<?php

declare(strict_types=1);

namespace App;

use DateTime;

//package for wrapping datetime class of php
use Carbon\Carbon;

class Rota
{
    public $weekCommenceDate;

    public $shifts;

    /**
     * Rota constructor.
     *
     * @param DateTime $weekCommenceDate
     * @param array $shifts
     */
    public function __construct(DateTime $weekCommenceDate, array $shifts)
    {
      
        $this->weekCommenceDate = $weekCommenceDate;
        $this->shifts = $shifts;
    }
}
