<?php

declare(strict_types=1);

namespace Test;

use DateInterval;
use DateTime;
use Exception;

class TestCase extends \PHPUnit\Framework\TestCase
{
    /**
     * Just helper method to add hours to today's datetime.
     *
     * @param int $hours
     * @param DateTime|null $dateTime
     *
     * @return DateTime
     * @throws Exception|Exception
     */
    protected function todayAddHours(int $hours, ?DateTime $dateTime = null): DateTime
    {
        $dt = $dateTime ? $dateTime : (new DateTime('today'));

        return $dt->add(new DateInterval('PT' . $hours . 'H'));
    }

    /**
     * Just helper method to add hours to tomorrow's datetime.
     *
     * @param int $hours
     *
     * @return DateTime
     * @throws Exception
     */
    protected function tomorrowAddHours(int $hours): DateTime
    {
        return (new DateTime('tomorrow'))
            ->add(new DateInterval('PT' . $hours . 'H'));
    }

    /**
     * Just helper method to add hours to specific datetime.
     *
     * @param DateTime $dateTime
     * @param int $hours
     *
     * @return DateTime
     * @throws Exception
     */
    protected function addHours(DateTime $dateTime, int $hours): DateTime
    {
        return $dateTime->add(new DateInterval('PT' . $hours . 'H'));
    }

    /**
     * Just helper method to add days to specific datetime.
     *
     * @param DateTime $dateTime
     * @param int $days
     *
     * @return DateTime
     * @throws Exception|Exception
     */
    protected function addDays(DateTime $dateTime, int $days): DateTime
    {
        return $dateTime->add(new DateInterval('P' . $days . 'D'));
    }
}
