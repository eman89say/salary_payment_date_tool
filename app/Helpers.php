<?php

namespace App;

class Helpers
{
    public static function pushToPaymentsPerMonths(
        array $paymentsPerMonths,
        \DateTime $date
    ) : array {
        $paymentsPerMonths[$date->format('M')] = [
            'salary' => self::getSalaryPaymentDate($date),
            'bonus' => self::getBonusPaymentDate($date)
        ];

        return $paymentsPerMonths;
    }

    public static function getSalaryPaymentDate($date) : string
    {
        $copy = clone $date;
        $lastDateOfTheMonth = $copy->modify('last day of this month');
    
        $lastDate = $lastDateOfTheMonth->format('Y-m-d');
    
        $lastDay = $lastDateOfTheMonth->format('D');
    
        $payDate = $lastDateOfTheMonth;
        $lastWorkingDay = $lastDay;
    
        while (self::isWeekend($lastWorkingDay)) {
              $payDate = $copy->modify('-1 day');
              $lastWorkingDay = $payDate->format('D');
        }
    
        return $payDate->format('Y-m-d');
    }

    public static function getBonusPaymentDate($date) : string
    {
        $month = $date->format('m');
        $year = $date->format('Y');
        $middleOfTheMonth = (new \DateTime())->setDate($year, $month, 15);
        $bonusPayDate = $middleOfTheMonth;

        if(self::isWeekend($middleOfTheMonth->format('D'))) {
            $bonusPayDate = $bonusPayDate->modify('+3 day');
            if(!self::isWednesday(($bonusPayDate)->format('D'))) {
                $bonusPayDate = $bonusPayDate->modify('+1 day');
            }
        }
        return $bonusPayDate->format('Y-m-d');
    }

    private static function isWeekend($day) : bool
    {
        return $day == 'Sat' || $day == 'Sun';
    }

    private static function isWednesday($day) : bool
    {
        return $day == 'Wed';
    }
}