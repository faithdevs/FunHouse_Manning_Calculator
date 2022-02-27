<?php

declare(strict_types=1);

namespace App;

use DateInterval;
use DateTime;

trait SingleManningCalculatorTrait
{
    /**
     * @param array $shifts
     *
     * @return array
     */
    private static function orderShiftsByStartTime(array $shifts): array
    {
        //dd($shifts);
        
        //usort($shifts, fn($a, $b) => $a->startTime >= $b->startTime);
        usort($shifts, function($a, $b){
            return $a->startTime <=> $b->startTime;
        });

        return $shifts;
    }

    /**
     * Return shifts payload grouped by day
     *
     * @param Rota $rota
     *
     * @return array
     */
    private static function groupShiftsByDay(Rota $rota): array
    {
        $groupedShiftsByDay = [];

        foreach ($rota->shifts as $shift) {
            $day = $shift->startTime->format('d-m-Y');
            $groupedShiftsByDay[$day][] = $shift;
        }

        return $groupedShiftsByDay;
    }

    /**
     * @param DateTime $firstValue
     * @param DateTime $secondValue
     *
     * @return DateTime
     */
    private static function minTime(DateTime $firstValue, DateTime $secondValue): DateTime
    {
        return $firstValue < $secondValue ? $firstValue : $secondValue;
    }

    /**
     * @param DateTime $firstValue
     * @param DateTime $secondValue
     *
     * @return DateTime
     */
    private static function maxTime(DateTime $firstValue, DateTime $secondValue): DateTime
    {
        return $firstValue > $secondValue ? $firstValue : $secondValue;
    }

    /**
     * @param DateTime $firstDate
     * @param DateTime $secondDate
     *
     * @return int
     */
    private static function maxInterval(DateTime $firstDate, DateTime $secondDate): int
    {
        return $firstDate > $secondDate
            ? max(abs(self::getTotalMinutes($firstDate->diff($secondDate))), 0)
            : max(-1 * abs(self::getTotalMinutes($firstDate->diff($secondDate))), 0);
    }

    /**
     * @param DateInterval $dateInterval
     *
     * @return int
     */
    private static function getTotalMinutes(DateInterval $dateInterval): int
    {
        return ($dateInterval->d * 24 * 60) + ($dateInterval->h * 60) + $dateInterval->i;
    }
}
