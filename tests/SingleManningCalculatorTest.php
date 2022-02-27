<?php

declare(strict_types=1);

namespace Test;

use App\Rota;
use App\Shift;
use App\SingleManningCalculator;
use App\SingleManningList;
use DateTime;
use InvalidArgumentException;

class SingleManningCalculatorTest extends TestCase
{
    public function test_scenario_one()
    {
        $startTime = new DateTime('2022-07-05 08:00:00.0');
        $endTime = new DateTime('2022-07-05 17:00:00.0');
        $weekCommenceDate = new DateTime('2022-07-01');

        $rota = new Rota(
            $weekCommenceDate,
            [
                new Shift($startTime, $endTime, 'Black Widow')
            ]
        );

        $expected = new SingleManningList(
            [   //calculated bonus based on the shift 
                '05-07-2022' => 540
            ]
        );

        $singleManning = SingleManningCalculator::calculateSingleManning($rota);

       
        $this->assertEquals($expected, $singleManning);
    }

    public function test_should_throw_invalid_argument_exception_if_start_time_greater_than_end_time()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('End time must be greater than start time.');

        $startTime = new DateTime('2022-07-05 17:00:00.0');
        $endTime = new DateTime('2022-07-05 08:00:00.0');

        new Rota(
            new DateTime('2022-07-01'),
            [
                new Shift($startTime, $endTime, 'Black Widow')
            ]
        );
    }

    public function test_scenario_two()
    {
        $blackWidowStartTime = new DateTime('2022-07-06 08:00:00.0');
        $blackWidowEndTime = new DateTime('2022-07-06 12:00:00.0');

        $thorStartTime = new DateTime('2022-07-06 12:00:00.0');
        $thorEndTime = new DateTime('2022-07-06 17:00:00.0');

        $rota = new Rota(
            new DateTime('2022-07-02'),
            [
                new Shift($blackWidowStartTime, $blackWidowEndTime, 'Black Widow'),
                new Shift($thorStartTime, $thorEndTime, 'Thor'),
            ]
        );

        $expected = new SingleManningList(
            [
                '06-07-2022' => 540
            ]
        );

        $singleManning = SingleManningCalculator::calculateSingleManning($rota);

        $this->assertEquals($expected, $singleManning);
    }

    public function test_scenario_three()
    {
        $wolverineStartTime = new DateTime('2022-07-07 08:00:00.0');
        $wolverineEndTime = new DateTime('2022-07-07 14:00:00.0');

        $gamoraStartTime = new DateTime('2022-07-07 09:00:00.0');
        $gamoraEndTime = new DateTime('2022-07-07 17:00:00.0');

        $rota = new Rota(
            new DateTime('2022-07-01'),
            [
                new Shift($wolverineStartTime, $wolverineEndTime, 'Wolverine'),
                new Shift($gamoraStartTime, $gamoraEndTime, 'Gamora'),
            ]
        );

        $expected = new SingleManningList(
            [
                '07-07-2022' => 240
            ]
        );

        $singleManning = SingleManningCalculator::calculateSingleManning($rota);

        $this->assertEquals($expected, $singleManning);
    }

 
}
