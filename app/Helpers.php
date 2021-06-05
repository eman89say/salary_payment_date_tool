<?php

namespace App;

use DateTime;

class Helpers
{
    const SALARY = 'salary';
    const BONUS = 'bonus';

    public static function pushToPaymentsPerMonths(
        array $paymentsPerMonths,
        DateTime $date
    ) : array {
        $paymentsPerMonths[$date->format('M')] = [
            self::SALARY => self::getSalaryPaymentDate($date),
            self::BONUS => self::getBonusPaymentDate($date)
        ];

        return $paymentsPerMonths;
    }

    public static function getSalaryPaymentDate(DateTime $date) : string
    {
        $copy = clone $date;
        $payDate = $lastDateOfTheMonth = $copy->modify('last day of this month');
        
        $lastWorkingDay = $lastDay = $lastDateOfTheMonth->format('D');
        
        while (self::isWeekend($lastWorkingDay)) {
              $payDate = $copy->modify('-1 day');
              $lastWorkingDay = $payDate->format('D');
        }
    
        return $payDate->format('Y-m-d');
    }

    public static function getBonusPaymentDate(DateTime $date) : string
    {
        $month = $date->format('m');
        $year = $date->format('Y');
        $bonusPayDate = $middleOfTheMonth = (new DateTime())->setDate($year, $month, 15);

        if(self::isWeekend($middleOfTheMonth->format('D'))) {
            $bonusPayDate = $bonusPayDate->modify('+3 day');
            if(!self::isWednesday(($bonusPayDate)->format('D'))) {
                $bonusPayDate->modify('+1 day');
            }
        }
        return $bonusPayDate->format('Y-m-d');
    }

    private static function isWeekend(string $day) : bool
    {
        return $day == 'Sat' || $day == 'Sun';
    }

    private static function isWednesday(string $day) : bool
    {
        return $day == 'Wed';
    }
}